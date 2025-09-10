<?php 

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Models\Fkrtl;

class PelayananController extends Controller
{
    public function index()
    {
        $pelayanan = Pelayanan::all();

        foreach ($pelayanan as $item) {
        
            $item->tgl_bast_formatted = $item->tgl_bast ? date('d-m-Y', strtotime($item->tgl_bast)) : null;
            $item->tgl_bakb_formatted = $item->tgl_bakb ? date('d-m-Y', strtotime($item->tgl_bakb)) : null;
            $item->tgl_bahv_formatted = $item->tgl_bahv ? date('d-m-Y', strtotime($item->tgl_bahv)) : null;
            $item->tgl_jt_formatted = $item->tgl_jt ? date('d-m-Y', strtotime($item->tgl_jt)) : null;

            if ($item->tgl_bast) {
                $item->max_tgl_bakb = date('Y-m-d', strtotime($item->tgl_bast . ' +9 days'));
                $item->max_tgl_bakb_formatted = date('d-m-Y', strtotime($item->tgl_bast . ' +9 days'));
                
                if (!$item->tgl_bakb) {
                    $item->max_tgl_bahv = date('Y-m-d', strtotime($item->max_tgl_bakb . ' +9 days'));
                    $item->max_tgl_bahv_formatted = date('d-m-Y', strtotime($item->max_tgl_bakb . ' +9 days'));
                    $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->max_tgl_bakb . ' +14 days'));
                    $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->max_tgl_bakb . ' +14 days'));
                } else {
                    $item->max_tgl_bahv = date('Y-m-d', strtotime($item->tgl_bakb . ' +9 days'));
                    $item->max_tgl_bahv_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +9 days'));
                    $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->tgl_bakb . ' +14 days'));
                    $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +14 days'));
                }
            } else {
                $item->max_tgl_bakb = null;
                $item->max_tgl_bakb_formatted = null;
                $item->max_tgl_bahv = null;
                $item->max_tgl_bahv_formatted = null;
                $item->tgl_jt_calculated = null;
                $item->tgl_jt_calculated_formatted = null;
            }
        }

        return view('pelayanan.index', compact('pelayanan'));
    }

    public function create(Request $request)
    {
        $selectedFkrtl = null;
        
        if ($request->has('fkrtl_id')) {
            $selectedFkrtl = Fkrtl::where('id_fkrtl', $request->fkrtl_id)->first();
        }

        $fkrtlList = Fkrtl::orderBy('nama_rumah_sakit')->get();

        return view('pelayanan.create', compact('selectedFkrtl', 'fkrtlList'));
    }

    public function store(Request $request)
    {
        $validationRules = [
            'nama_fkrtl' => 'required',
            'bulan_pelayanan' => 'required',
            'jenis_pelayanan' => 'required',
            'jumlah_kasus' => 'required|integer',
            'biaya' => 'required|numeric',
        ];
        
        if ($request->jenis_pelayanan === 'Alat Kesehatan') {
            $validationRules['alat_kesehatan'] = 'required';
        }

        $request->validate($validationRules);

        $data = $request->all();
        
        if ($request->jenis_pelayanan === 'Alat Kesehatan') {
            $data['jenis_pelayanan'] = $request->alat_kesehatan;
        }
        
        if ($request->bulan_pelayanan) {
            $data['bulan_pelayanan'] = $request->bulan_pelayanan . '-01';
        }

        // Hitung tanggal-tanggal terkait (jika tgl_bast diisi)
        if (!empty($data['tgl_bast'])) {
            $data['max_tgl_bakb'] = date('Y-m-d', strtotime($data['tgl_bast'] . ' +9 days'));
            $data['max_tgl_bahv'] = date('Y-m-d', strtotime($data['max_tgl_bakb'] . ' +9 days'));
            $data['tgl_jt'] = date('Y-m-d', strtotime($data['max_tgl_bakb'] . ' +14 days'));
        }

        Pelayanan::create($data);

        return redirect()->route('pelayanan.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
   
        // Format untuk form input (YYYY-MM-DD)
        $pelayanan->tgl_bast_formatted = $pelayanan->tgl_bast ? date('Y-m-d', strtotime($pelayanan->tgl_bast)) : null;
        $pelayanan->tgl_bakb_formatted = $pelayanan->tgl_bakb ? date('Y-m-d', strtotime($pelayanan->tgl_bakb)) : null;
        $pelayanan->tgl_bahv_formatted = $pelayanan->tgl_bahv ? date('Y-m-d', strtotime($pelayanan->tgl_bahv)) : null;
        $pelayanan->tgl_jt_formatted = $pelayanan->tgl_jt ? date('Y-m-d', strtotime($pelayanan->tgl_jt)) : null;
        
        return view('pelayanan.edit', compact('pelayanan'));
    }

    public function update(Request $request, $id)
    {
        $validationRules = [
            'nama_fkrtl' => 'required',
            'bulan_pelayanan' => 'required',
            'jenis_pelayanan' => 'required',
            'jumlah_kasus' => 'required|integer',
            'biaya' => 'required|numeric',
        ];

        if ($request->jenis_pelayanan === 'Alat Kesehatan') {
            $validationRules['alat_kesehatan'] = 'required';
        }

        $request->validate($validationRules);

        $data = $request->except(['alat_kesehatan']);
        $pelayanan = Pelayanan::findOrFail($id);

        // Handle jenis pelayanan
        if ($request->jenis_pelayanan === 'Alat Kesehatan') {
            $data['jenis_pelayanan'] = $request->alat_kesehatan;
        } else {
            $data['jenis_pelayanan'] = $request->jenis_pelayanan;
        }

        // Format bulan_pelayanan
        if ($request->bulan_pelayanan) {
            $data['bulan_pelayanan'] = $request->bulan_pelayanan . '-01';
        }

        // Hitung tanggal maksimal berdasarkan tgl_bast
        if (!empty($data['tgl_bast'])) {
            $data['max_tgl_bakb'] = date('Y-m-d', strtotime($data['tgl_bast'] . ' +9 days'));
            $data['max_tgl_bahv'] = date('Y-m-d', strtotime($data['max_tgl_bakb'] . ' +9 days'));
            $data['tgl_jt'] = date('Y-m-d', strtotime($data['max_tgl_bakb'] . ' +14 days'));
        } else {
            $data['max_tgl_bakb'] = null;
            $data['max_tgl_bahv'] = null;
            $data['tgl_jt'] = null;
        }

        // Jika tgl_bakb diisi, update max_tgl_bahv dan tgl_jt berdasarkan tgl_bakb
        if (!empty($data['tgl_bakb'])) {
            $data['max_tgl_bahv'] = date('Y-m-d', strtotime($data['tgl_bakb'] . ' +9 days'));
            $data['tgl_jt'] = date('Y-m-d', strtotime($data['tgl_bakb'] . ' +14 days'));
        }

        $pelayanan->update($data);

        return redirect()->route('pelayanan.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pelayanan::findOrFail($id)->delete();

        return redirect()->route('pelayanan.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function calculateDates(Request $request)
    {
        $tgl_bast = $request->input('tgl_bast');
        
        if ($tgl_bast) {
            $max_tgl_bakb = date('Y-m-d', strtotime($tgl_bast . ' +9 days'));
            $max_tgl_bahv = date('Y-m-d', strtotime($max_tgl_bakb . ' +9 days'));
            $tgl_jt = date('Y-m-d', strtotime($max_tgl_bakb . ' +14 days'));
            
            return response()->json([
                'max_tgl_bakb' => $max_tgl_bakb,
                'max_tgl_bahv' => $max_tgl_bahv,
                'tgl_jt' => $tgl_jt,
                'max_tgl_bakb_formatted' => date('d-m-Y', strtotime($max_tgl_bakb)),
                'max_tgl_bahv_formatted' => date('d-m-Y', strtotime($max_tgl_bahv)),
                'tgl_jt_formatted' => date('d-m-Y', strtotime($tgl_jt))
            ]);
        }
        
        return response()->json([
            'max_tgl_bakb' => null,
            'max_tgl_bahv' => null,
            'tgl_jt' => null,
            'max_tgl_bakb_formatted' => null,
            'max_tgl_bahv_formatted' => null,
            'tgl_jt_formatted' => null
        ]);
    }
}