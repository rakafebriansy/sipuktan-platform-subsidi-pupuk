<?php

namespace App\Services\Impl;
use App\Models\KredensialUbahSandi;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Models\RiwayatChat;
use App\Services\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    private function pemilikKiosCekNomorTelepon(string $nomor_telepon): string|null
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
    public function service(Request $request): array
    {
        $text = $request['message']['text'];
        if($text == '/ubahsandipetani') {
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
        if($text == '/ubahsandikiosresmi') {
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
        if($text == '/sipuktan') {
            $rendered_view = $this->setRenderedView('sipuktan',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if($text == '/pupuk') {
            $rendered_view = $this->setRenderedView('pupuk',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if($text == '/kios') {
            $rendered_view = $this->setRenderedView('kios',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if($text == '/pupuktunai') {
            $rendered_view = $this->setRenderedView('pupuktunai',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if($text == '/pupuknontunai') {
            $rendered_view = $this->setRenderedView('pupuknontunai',[
                'link' => env('APP_URL')
            ]);
            return [
                'teks' => $rendered_view,
                'pengirim' => $request['message']['from']['id'],
            ];
        }
        if($text == '/menu') {
            $rendered_view = $this->setRenderedView('menu',[
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
            $result = $this->pemilikKiosCekNomorTelepon($nomor_telepon);
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