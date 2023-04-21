<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RedeemController extends Controller
{
    public function store(Request $request)
    {
        $key = $request->key;

        $key = \App\Models\Key::where('key', $key)->first();

        $userKeys = \App\Models\Key::all()->where('owner_id', auth()->user()->id);

        if (empty($key)) {
            return redirect()->back()->with('error', 'The license key does not exist.');
        }

        $hasScriptAlready = false;

        foreach ($userKeys as $userKey) {
            if($userKey->resource->id == $key->resource->id) {
                $hasScriptAlready = true;
            }
        }

        if($hasScriptAlready) {
            return redirect()->back()->with('error', 'You own this script already.');
        }


        if ($key->owner_id != null) {
            return redirect()->back()->with('error', 'The license key has already been redeemed.');
        }

        $key->owner_id = $request->user()->id;
        $key->claimed_at = Carbon::now();

        $key->save();

        Http::post('https://discord.com/api/webhooks/1008763409828937768/RIqvAOEd64yoGWaoB108NtLTfOWSMgA0gsdy5lHDeQvaWzbvGTnxQC5vZ3IfoL5qKklR?thread_id=1040651964087799838', [
            'embeds' => [
                [
                    "author" => [
                        "name" => 'xbx.wtf',
                        "icon_url" => 'https://cdn.discordapp.com/attachments/990678673835294730/1007428494843723836/xw_logo_animated.gif'
                    ],
                    "footer" => [
                        "text" => 'xbx.wtf',
                        "icon_url" => 'https://cdn.discordapp.com/attachments/990678673835294730/1007428494843723836/xw_logo_animated.gif'
                    ],
                    'title' => 'Key redeemed',
                    'description' => '> The key ||` ' . $key->key . ' `|| has been redeemed by ` ' . $request->user()->username . '#' . $request->user()->discriminator . ' `',
                    'color' => hexdec('2f3136'),
                    "timestamp" => date("c", strtotime("now"))
                ],
            ],
        ]);

        return redirect()->to('/')->with('message', 'Thanks for redeeming your license key!');
    }
}
