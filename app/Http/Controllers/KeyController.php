<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->resource)) {
            return redirect()->back()->with('error', 'A resource is required.');
        }

        if (empty($request->key)) {
            return redirect()->back()->with('error', 'A key is required.');
        }

        $key = \App\Models\Key::where('key', $request->key)->first();
        if ($key) {
            return redirect()->back()->with('error', 'A key with that name already exists.');
        }

        $key = new \App\Models\Key;

        $key->key = $request->key;
        $key->resource_id = $request->resource;

        $key->save();

        Http::post('https://discord.com/api/webhooks/1008763409828937768/RIqvAOEd64yoGWaoB108NtLTfOWSMgA0gsdy5lHDeQvaWzbvGTnxQC5vZ3IfoL5qKklR', [
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
                    'title' => 'Key created',
                    'description' => '> The key ||` ' . $key->key . ' `|| has been created by ` ' . $request->user()->username . '#' . $request->user()->discriminator . ' `',
                    'color' => hexdec('2f3136'),
                    "timestamp" => date("c", strtotime("now"))
                ],
            ],
        ]);


        return redirect()->back()->with('message', 'Key created.');
    }

    public function import(Request $request)
    {
        if (empty($request->resource)) {
            return redirect()->back()->with('error', 'A resource is required.');
        }

        if (empty($request->licenses)) {
            return redirect()->back()->with('error', 'A key is required.');
        }

        $licenses = $request->get('licenses');
        $licenses = preg_split("/\r\n|\n|\r/", $licenses);

        $counter = 0;

        foreach ($licenses as $license) {
            $key = \App\Models\Key::where('key', $license)->first();
            if ($key) continue;

            $key = new \App\Models\Key;

            $key->key = $license;
            $key->resource_id = $request->resource;

            $key->save();
            $counter++;
        }

        return redirect()->back()->with('message', 'Keys created ('. $counter . ').');
    }

    public function apiCheck(Request $request, $id)
    {
        $key = \App\Models\Key::where('value', $request->ip())->whereRelation('resource', 'name', $id)->first();

        if($key) {
            return response()->json([
                "ip" => $request->ip(),
                "status" => "200"
            ]);
        } else {
            return response()->json([
                "ip" => $request->ip(),
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $key = \App\Models\Key::find($id);

        if(!$key) {
            return redirect()->back()->with('error', 'Key not found.');
        }

        return view('products.manage')->with('key', $key);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$key = \App\Models\Key::find($id);
        //if(!$key) {
        //    return redirect()->back()->with('error', 'Key not found.');
        //}
        //if($key->owner_id != auth()->user()->id) {
        //    return redirect()->to('/products/')->with('error', 'You do not have permission to edit this key.');
        //}

        $resource = \App\Models\Resource::find($id);

        if(!$resource) {
            return redirect()->back()->with('error', 'Resource not found.');
        }

        $keys = \App\Models\Key::all()->where('owner_id', auth()->user()->id);

        $key = null;

        foreach ($keys as $k) {
            if($k->resource->id == $id) {
                $key = $k;
                break;
            }
        }

        if(!$key) {
            return redirect()->back()->with('error', 'You do not own this product');
        }

        // ip regex check

        if($key->resource->lock_type == 'ipv4') {
            if (filter_var($request->value, FILTER_VALIDATE_IP)) {
                $key->value = $request->value;
            } else {
                return redirect()->back()->with('error', 'Invalid IP-Address.');
            }
        } else if($key->resource->lock_type == 'discord-guild') {
            if (is_numeric($request->value) && strlen($request->value) >= 17) {
                $key->value = $request->value;
            } else {
                return redirect()->back()->with('error', 'Invalid Guild-ID.');
            }
        }else if($key->resource->lock_type == 'hwid') {
            if (!empty($request->value)) {
                $key->value = $request->value;
            } else {
                return redirect()->back()->with('error', 'Invalid HWID.');
            }
        }


        $key->save();
        return redirect()->back()->with('message', 'Key updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $key = \App\Models\Key::find($id);

        if(!$key) {
            return redirect()->back()->with('error', 'Key not found.');
        }

        $keyString = $key->key;

        $key->delete();

        Http::post('https://discord.com/api/webhooks/1008763409828937768/RIqvAOEd64yoGWaoB108NtLTfOWSMgA0gsdy5lHDeQvaWzbvGTnxQC5vZ3IfoL5qKklR', [
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
                    'title' => 'Key deleted',
                    'description' => '> The key ||` ' . $keyString . ' `|| has been deleted by ` ' . auth()->user()->username . '#' . auth()->user()->discriminator . ' `',
                    'color' => hexdec('2f3136'),
                    "timestamp" => date("c", strtotime("now"))
                ],
            ],
        ]);

        return redirect()->back()->with('message', 'Key deleted.');
    }
}
