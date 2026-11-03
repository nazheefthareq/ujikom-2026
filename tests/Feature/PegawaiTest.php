<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PegawaiTest extends TestCase
{
    use RefreshDatabase;

    public function test_tamu_dialihkan_ke_halaman_login(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->get(route('pegawai.index'))->assertRedirect(route('login'));
    }

    public function test_admin_dapat_login_dan_melihat_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@ukom.test',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'admin@ukom.test',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_dapat_menambah_mengubah_dan_menghapus_pegawai(): void
    {
        $admin = User::factory()->create();

        // 1. Tambah pegawai baru
        $this->actingAs($admin)->post(route('pegawai.store'), [
            'nama' => 'Rudi Hartono',
            'jenis_kelamin' => 'L',
            'pendidikan_terakhir' => 'S1',
            'tanggal_lahir' => '1995-05-10',
        ])->assertRedirect(route('pegawai.index'));

        $pegawai = Pegawai::first();
        $this->assertNotNull($pegawai);
        $this->assertEquals('Rudi Hartono', $pegawai->nama);

        // 2. Ubah data pegawai
        $this->actingAs($admin)->put(route('pegawai.update', $pegawai), [
            'nama' => 'Rudi Hartono Wijaya',
            'jenis_kelamin' => 'L',
            'pendidikan_terakhir' => 'S2',
            'tanggal_lahir' => '1995-05-10',
        ])->assertRedirect(route('pegawai.index'));

        $this->assertDatabaseHas('pegawai', [
            'id' => $pegawai->id,
            'nama' => 'Rudi Hartono Wijaya',
            'pendidikan_terakhir' => 'S2',
        ]);

        // 3. Hapus data pegawai dengan method DELETE
        $this->actingAs($admin)->delete(route('pegawai.destroy', $pegawai))
            ->assertRedirect(route('pegawai.index'));

        $this->assertDatabaseMissing('pegawai', ['id' => $pegawai->id]);
    }

    public function test_validasi_menolak_input_pegawai_tidak_valid(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('pegawai.store'), [
            'nama' => '',
            'jenis_kelamin' => 'X',
            'pendidikan_terakhir' => 'D4',
            'tanggal_lahir' => now()->addYear()->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors([
            'nama',
            'jenis_kelamin',
            'pendidikan_terakhir',
            'tanggal_lahir',
        ]);
    }
}