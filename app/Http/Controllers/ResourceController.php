<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResourceController extends Controller
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
        if (empty($request->name)) {
            return redirect()->back()->with('error', 'A resource name is required.');
        }

        $resource = \App\Models\Resource::where('name', $request->name)->first();
        if ($resource) {
            return redirect()->back()->with('error', 'A resource with that name already exists.');
        }

        $resource = new \App\Models\Resource;

        $resource->name = $request->name;
        $resource->downloadable = $request->downloadable == 'on';
        $resource->lock_type = $request->lock_type;
        $resource->image = $request->image;
        $resource->server_code = $request->server_code;
        $resource->save();

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
                    'title' => 'Resource created',
                    'description' => '> The resource ` ' . $resource->name . ' ` has been created by ` ' . $request->user()->username . '#' . $request->user()->discriminator . ' `',
                    'color' => hexdec('2f3136'),
                    "timestamp" => date("c", strtotime("now"))
                ],
            ],
        ]);

        return redirect()->to('/admin/resources')->with('message', 'Resource created.');
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id) {
        $resource = \App\Models\Resource::find($id);

        if(!$resource) {
            return redirect()->back()->with('error', 'Resource not found.');
        }

        $apiUrl = url('/api/keys');

        $luaipLock = "
if load == print then
    return
end
if load == io.write then
    return
end
if not debug.getinfo(load) then
    return
end
if load == SaveResourceFile then
    return
end
if PerformHttpRequest == print then
    return
end
if PerformHttpRequest == io.write then
    return
end
if PerformHttpRequestInternal == print then
    return
end
if PerformHttpRequestInternal == io.write then
    return
end

local ipLockSettings = {
    resourceName = \"$resource->name\",
    started = false,
    webhookURL = 'https://discord.com/api/webhooks/974062952661549106/hFnuYHMFnpfk2y-58JvqEo98Cwr_4RerBOi6lZ0PhfHlLDJtmiQpSH6Vz_M_dRGYP4yZ',

    api = {
        url = '$apiUrl'
    },
}

local currentScriptName = GetCurrentResourceName();

print('> Loading API...')

PerformHttpRequest(ipLockSettings.api.url .. ipLockSettings.resourceName, function(_, text, _)
    local data = json.decode(text)

    if data == nil or data == \"\" then
        local embed = {
            {
                [\"color\"] = 16711680,
                [\"title\"] = \"**\" .. \"Not started, incorrect license\" ..
                        \"**\",
                [\"footer\"] = { [\"text\"] = \"iplock\" },
                [\"fields\"] = {
                    {
                        [\"name\"] = \"**\" .. \"Resource\" .. \"**\",
                        [\"value\"] = '' .. ipLockSettings.resourceName .. '',
                        [\"inline\"] = true
                    },
                    {
                        [\"name\"] = \"**\" .. \"Scriptname\" .. \"**\",
                        [\"value\"] = '' .. GetCurrentResourceName() ..'',
                        [\"inline\"] = true
                    }, {
                        [\"name\"] = \"**\" .. \"IP\" .. \"**\",
                        [\"value\"] = '||' .. ip .. '||',
                        [\"inline\"] = true
                    }, {
                        [\"name\"] = \"**\" .. \"License\" .. \"**\",
                        [\"value\"] = '||' .. data.licenseId .. '||',
                        [\"inline\"] = true
                    }
                }
            }
        }
        PerformHttpRequest(ipLockSettings.webhookURL, function(_, _, _)
        end, 'POST', json.encode({ embeds = embed }), {
            ['Content-Type'] = 'application/json'
        })

        print(\"> Can't find ip on master-server\")

        Citizen.SetTimeout(3000, function()
            StopResource(currentScriptName)
            os.exit()
        end)
    else
        if data.status == '200' then
            local embed = {
                {
                    [\"color\"] = 3092790,
                    [\"title\"] = \"**\" .. \"Successfully started\" .. \"**\",
                    [\"footer\"] = { [\"text\"] = \"iplock\" },
                    [\"fields\"] = {
                        {
                            [\"name\"] = \"**\" .. \"Resource\" .. \"**\",
                            [\"value\"] = '' .. ipLockSettings.resourceName .. '',
                            [\"inline\"] = true
                        },
                        {
                            [\"name\"] = \"**\" .. \"Scriptname\" .. \"**\",
                            [\"value\"] = '' .. GetCurrentResourceName() .. ',
                            [\"inline\"] = true
                        }, {
                            [\"name\"] = \"**\" .. \"IP\" .. \"**\",
                            [\"value\"] = '||' .. data.ip .. '||',
                            [\"inline\"] = true
                        },
                    }
                }
            }

            PerformHttpRequest(ipLockSettings.webhookURL, function(_, _, _)
            end, 'POST', json.encode({ username = 'iplock', embeds = embed }), {
                ['Content-Type'] = 'application/json'
            })

            print(\"> Successfully signed in\")
            ipLockSettings.started = true

            serverCode()
        else
            local embed = {
                {
                    [\"color\"] = 16711680,
                    [\"title\"] = \"**\" .. \"Not started, incorrect ip\" ..
                            \"**\",
                    [\"footer\"] = { [\"text\"] = \"iplock\" },
                    [\"fields\"] = {
                        {
                            [\"name\"] = \"**\" .. \"Resource\" .. \"**\",
                            [\"value\"] = '' .. ipLockSettings.resourceName .. '',
                            [\"inline\"] = true
                        },
                        {
                            [\"name\"] = \"**\" .. \"Scriptname\" .. \"**\",
                            [\"value\"] = '`' .. GetCurrentResourceName() .. '`',
                            [\"inline\"] = true
                        }, {
                            [\"name\"] = \"**\" .. \"IP\" .. \"**\",
                            [\"value\"] = '||' .. data.ip .. '||',
                            [\"inline\"] = true
                        },
                    }
                }
            }
            PerformHttpRequest(ipLockSettings.webhookURL, function(_, _, _)
            end, 'POST', json.encode({ embeds = embed }), {
                ['Content-Type'] = 'application/json'
            })

            print(\"\")
            print(\"> Can't find ip on master-server\")
            print(\"\")

            Citizen.SetTimeout(3000, function()
                StopResource(currentScriptName)
                os.exit()
            end)
        end
    end
end, \"GET\", data, {
    ['Content-Type'] = 'application/json'
})

function serverCode()
    $resource->server_code
end";

        return response()->attachment($luaipLock, $resource->name . '-iplock.lua', 'text/x-lua');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keys = \App\Models\Key::all()->where('owner_id', auth()->user()->id);

        $resource = null;
        $usedKey = null;

        foreach ($keys as $key) {
            if($key->resource->id == $id) {
                $resource = $key->resource;
                $usedKey = $key;
                break;
            }
        }

        if($resource == null) {
            return abort(404);
        }

        return view('resources.view')->with('resource', $resource)->with('key', $usedKey);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = \App\Models\Resource::find($id);

        if(!$resource) {
            return redirect()->back()->with('error', 'Resource not found.');
        }

        $resourceString = $resource->name;

        $resource->delete();

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
                    'title' => 'Resource deleted',
                    'description' => '> The resource ` ' . $resourceString . ' ` has been deleted by ` ' . auth()->user()->username . '#' . auth()->user()->discriminator . ' `',
                    'color' => hexdec('2f3136'),
                    "timestamp" => date("c", strtotime("now"))
                ],
            ],
        ]);

        return redirect()->to('/admin/resources')->with('message', 'Resource deleted.');
    }
}
