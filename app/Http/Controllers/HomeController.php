<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Header;
use App\User;
use App\Daily;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $indexBulan = date('m');
        $data['header'] = Header::with(['Daily'])->where('user_id',$user_id)
                ->where('bulan',$indexBulan)
                ->get();

        return view('home')->with($data);
    }

    public function BuatBaru()
    {
        return view('create');
    }

    public function save(Request $request)
    {
        $user_id = Auth::user()->id;
        $noind = Auth::user()->username;
        $head = Header::create([
            'user_id' => $user_id,
            'noind' => $noind,
            'bulan' => $request->bulan,
            'atasan' => $request->atasan,
            'tahun' => date('Y')
        ]);
        
        for ($i=0; $i < count($request->hari); $i++) { 
            $daily = Daily::create([
                'header_id' => $head->id,
                'noind' => $noind,
                'hari' => $request->hari[$i],
                'tanggal' => date('Y-m-d',strtotime($request->tanggal[$i])),
                'kegiatan' => $request->kegiatan[$i],
                'keterangan' => $request->keterangan[$i]
            ]);
        }
        // return response()->json(array('success' => true, 'last_insert_id' => $data->id), 200);
        return redirect(route('home'));
    }

    public function update(Request $request)
    {
        for ($i=0; $i < count($request->id); $i++) { 
            Daily::where('id', $request->id[$i])
            ->update([
                'kegiatan' => $request->kegiatan[$i],
                'keterangan' => $request->keterangan[$i],
            ]);
        }

        return redirect(route('home'));
    }

    public function generatePDF()

    {

        $user_id = Auth::user()->id;
        $indexBulan = date('m');
        $data['header'] = Header::with(['Daily'])->where('user_id',$user_id)
                ->where('bulan',$indexBulan)
                ->get();

        $pdf = PDF::loadView('coba', $data);
        $pdf->setPaper('A4', 'landscape');

  

        return $pdf->download('coba.pdf');
        // return view('coba',$data);

    }
}
