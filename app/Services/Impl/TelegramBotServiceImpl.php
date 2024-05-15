<?php

namespace App\Services\Impl;
use App\Models\KredensialUbahSandi;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Models\RiwayatChat;
use App\Services\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TelegramBotServiceImpl implements TelegramBotService
{
    private function setRenderedView(string $view, array $data = []): string
    {
        return view('bot.' . $view, $data)->render();
    }
    private function petaniCekNomorTelepon(string $nomor_telepon): string|null
    {
        $petani = Petani::where('nomor_telepon',$nomor_telepon)->first();
        if(isset($petani)) {
            $token = DB::transaction(function() use($petani) {
                $token = uniqid();
                $petani->update(['token' => $token]);
                return $token;
            });
            return $token;
        }
        return null;
    }
    private function kiosResmiCekNomorTelepon(string $nomor_telepon): string|null
    {
        $pemilik_kios = PemilikKios::where('nomor_telepon',$nomor_telepon)->first();
        if(isset($pemilik_kios)) {
            $token = DB::transaction(function() use($pemilik_kios) {
                $token = uniqid();
                $pemilik_kios->kios_resmi->update(['token' => $token]);
                return $token;
            });
            return $token;
        }
        return null;
    }
    private function petaniGetInfoKios(string $nik, string $kata_sandi): array|null
    {
        $petani = Petani::where('nik',$nik)->first();
        if(isset($petani) && Hash::check($kata_sandi, $petani->kata_sandi)) {
            $kios_resmi = $petani->kelompok_tani->kios_resmi;
            $kecamatan = $kios_resmi->kecamatan;
            return [
                'nama' => $kios_resmi->nama,
                'alamat' => $kios_resmi->jalan . ', ' . $kecamatan->nama,
            ];
        }
        return null;
    }
    private function petaniGetInfoPupuk(string $nik, string $kata_sandi): array|null
    {
        $petani = Petani::where('nik',$nik)->first();
        $now = now()->format('Y');
        if(isset($petani) && Hash::check($kata_sandi, $petani->kata_sandi)) {
            $alokasis_1 = $petani->alokasis->where('tahun',$now)->where('musim_tanam','MT1');
            $alokasis_2 = $petani->alokasis->where('tahun',$now)->where('musim_tanam','MT1');
            $alokasis_3 = $petani->alokasis->where('tahun',$now)->where('musim_tanam','MT1');
            return [
                'alokasis_1' => $alokasis_1,
                'alokasis_2' => $alokasis_2,
                'alokasis_3' => $alokasis_3
            ];
        }
        return null;
    }
    public function service(Request $request): array
    {
        $text = $request['message']['text'];
        if(str_contains($text,'/ubahsandipetani')) {
            return [
                'teks' => 'Silahkan masukkan nomor telepon terdaftar petani anda!',
                'pengirim' => $request['message']['from']['id'],
                'reply_markup' => [
                    'keyboard' =>[[[
                        'text'=>'Kirim nomor telepon saya',
                        'request_contact'=>true,
                    ]]],
                    'resize_keyboard'=>true,
                    'one_time_keyboard'=>true,
                ]
            ];
        }
        if(str_contains($text,'/ubahsandikiosresmi')) {
            return [
                'teks' => 'Silahkan masukkan nomor telepon terdaftar kios resmi anda!',
                'pengirim' => $request['message']['from']['id'],
                'reply_markup' => [
                    'keyboard' =>[[[
                        'text'=>'Kirim nomor telepon saya',
                        'request_contact'=>true,
                    ]]],
                    'resize_keyboard'=>true,
                    'one_time_keyboard'=>true,
                ]
            ];
        }
        if(str_contains($text,'/subsidi')) {
            $rendered_view = $this->setRenderedView('subsidi');
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/alur')) {
            $rendered_view = $this->setRenderedView('alur');
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/sipuktan')) {
            $rendered_view = $this->setRenderedView('sipuktan',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/kios')) {
            $separated = explode(' ',$text);
            if(count($separated) == 3) {
                $data = $this->petaniGetInfoKios($separated[1],$separated[2]);
                if(isset($data)) {
                    $rendered_view = $this->setRenderedView('kios-success',[
                        'nama' => $data['nama'],
                        'alamat' => $data['alamat']
                    ]);
                } else {
                    $rendered_view = $this->setRenderedView('kios-failed');
                }
                return [
                    'teks' => $rendered_view,
                    'pengirim' => $request['message']['from']['id'],
                ];
            }
            $rendered_view = $this->setRenderedView('kios',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/pupuk')) {
            $separated = explode(' ',$text);
            if(count($separated) == 3) {
                $data = $this->petaniGetInfoPupuk($separated[1],$separated[2]);
                if(isset($data)) {
                    $rendered_view = $this->setRenderedView('pupuk-success',[
                        'alokasis_1' => $data['alokasis_1'],
                        'alokasis_2' => $data['alokasis_2'],
                        'alokasis_3' => $data['alokasis_3'],
                    ]);
                    // $rendered_view = json_encode($alokasis[0]->musim_tanam);
                } else {
                    $rendered_view = json_encode($alokasis);
                }
                return [
                    'teks' => $rendered_view,
                    'pengirim' => $request['message']['from']['id'],
                ];
            }
            $rendered_view = $this->setRenderedView('pupuk',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if($text == '/belipupuk') {
            $rendered_view = $this->setRenderedView('belipupuk',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/pupuktunai')) {
            $rendered_view = $this->setRenderedView('pupuktunai',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/pupuknontunai')) {
            $rendered_view = $this->setRenderedView('pupuknontunai',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/menu')) {
            $rendered_view = $this->setRenderedView('menu',[
                'first_name' => $request['message']['from']['first_name']
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if(str_contains($text,'/registrasiweb')) {
            $rendered_view = $this->setRenderedView('registrasiweb',[
                'first_name' => $request['message']['from']['first_name']
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        return [
            'teks' => 'klik /menu',
            'pengirim' => $request['message']['from']['id'],
        ];
    }
    public function replyService(Request $request): array
    {
        $text = $request['message']['reply_to_message']['text'];
        if($text == 'Silahkan masukkan nomor telepon terdaftar petani anda!') {
            $nomor_telepon = $request['message']['contact']['phone_number'];
            if(substr($nomor_telepon,0,3) == '+62') $nomor_telepon = str_replace('+62','0',$nomor_telepon);
            $result = $this->petaniCekNomorTelepon($nomor_telepon);
            if(isset($result)) {
                $text = 'Masukkan token berikut pada website: <b>'.$result.'</b>';
            } else {
                $text = 'Nomor anda tidak terdaftar!';
            }
            return [
                'teks' => $text,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if($text == 'Silahkan masukkan nomor telepon terdaftar kios resmi anda!') {
            $nomor_telepon = $request['message']['contact']['phone_number'];
            if(substr($nomor_telepon,0,3) == '+62') $nomor_telepon = str_replace('+62','0',$nomor_telepon);
            $result = $this->kiosResmiCekNomorTelepon($nomor_telepon);
            if(isset($result)) {
                $text = 'Masukkan token berikut pada website: <b>'.$result.'</b>';
            } else {
                $text = 'Nomor anda tidak terdaftar!';
            }
            return [
                'teks' => $text,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        return [
            'teks' => 'klik /menu',
            'pengirim' => $request['message']['from']['id'],
        ];
    }
}