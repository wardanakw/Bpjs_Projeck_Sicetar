<?php 

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Models\Fkrtl;
use App\Exports\PelayananExport;
use Maatwebsite\Excel\Facades\Excel;

class PelayananController extends Controller
{
    public function index(Request $request)
{
    $query = Pelayanan::query();

    $query->where(function($q) {
        $q->whereNull('koreksi')
          ->orWhere('koreksi', 0);
    });

    $query->whereNull('tgl_reg_boa');

    $sortBy = $request->get('sort_by', 'created_at');
    $sortOrder = $request->get('sort_order', 'desc');
    
    switch ($sortBy) {
        case 'max_tgl_bakb':
            $query->orderBy('max_tgl_bakb', $sortOrder);
            break;
        case 'max_tgl_bahv':
            $query->orderBy('max_tgl_bahv', $sortOrder);
            break;
        case 'tgl_jt':
            $query->orderBy('tgl_jt', $sortOrder);
            break;
        default:
            $query->orderBy('created_at', $sortOrder);
    }
    
    $pelayanan = $query->get();

    foreach ($pelayanan as $item) {
        $item->tgl_bast_formatted = $item->tgl_bast ? date('d-m-Y', strtotime($item->tgl_bast)) : null;
        $item->tgl_bakb_formatted = $item->tgl_bakb ? date('d-m-Y', strtotime($item->tgl_bakb)) : null;
        $item->tgl_bahv_formatted = $item->tgl_bahv ? date('d-m-Y', strtotime($item->tgl_bahv)) : null;
        $item->tgl_jt_formatted = $item->tgl_jt ? date('d-m-Y', strtotime($item->tgl_jt)) : null;

        if ($item->tgl_bast) {
            $item->max_tgl_bakb = date('Y-m-d', strtotime($item->tgl_bast . ' +9 days'));
            $item->max_tgl_bakb_formatted = date('d-m-Y', strtotime($item->tgl_bast . ' +9 days'));
            
            if ($item->tgl_bakb) {
                $item->max_tgl_bahv = date('Y-m-d', strtotime($item->tgl_bakb . ' +9 days'));
                $item->max_tgl_bahv_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +9 days'));
            } else {
                $item->max_tgl_bahv = null;
                $item->max_tgl_bahv_formatted = null;
            }
        } else {
            $item->max_tgl_bakb = null;
            $item->max_tgl_bakb_formatted = null;
            $item->max_tgl_bahv = null;
            $item->max_tgl_bahv_formatted = null;
        }

        if ($this->isAlkes($item->jenis_pelayanan)) {
            if ($item->tgl_bahv) {
                $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->tgl_bahv . ' +14 days'));
                $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->tgl_bahv . ' +14 days'));
            } else {
                $item->tgl_jt_calculated = null;
                $item->tgl_jt_calculated_formatted = null;
            }
        } else {
            if ($item->tgl_bakb) {
                $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->tgl_bakb . ' +14 days'));
                $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +14 days'));
            } else {
                $item->tgl_jt_calculated = null;
                $item->tgl_jt_calculated_formatted = null;
            }
        }
    }

    return view('pelayanan.index', compact('pelayanan', 'sortBy', 'sortOrder'));
}
 public function monitoringSla(Request $request)
{
    $query = Pelayanan::query();

    $query->where(function($q) {
        $q->whereNull('tgl_reg_boa')
          ->orWhere('koreksi', 0)
          ->orWhereNull('koreksi');
    });

    $sortBy = $request->get('sort_by', 'max_tgl_bakb');
    $sortOrder = $request->get('sort_order', 'asc');
    
    if ($request->has('hide_completed') && $request->hide_completed == '1') {
        $query->whereNull('tgl_reg_boa');
    }

    if ($sortBy && in_array($sortBy, ['max_tgl_bakb', 'max_tgl_bahv', 'tgl_jt', 'tgl_bast'])) {
        $query->orderBy($sortBy, $sortOrder);
    }

    $pelayanan = $query->get();

    foreach ($pelayanan as $item) {
        $item->tgl_bast_formatted = $item->tgl_bast ? date('d-m-Y', strtotime($item->tgl_bast)) : '';
        $item->tgl_bakb_formatted = $item->tgl_bakb ? date('d-m-Y', strtotime($item->tgl_bakb)) : '';
        $item->tgl_bahv_formatted = $item->tgl_bahv ? date('d-m-Y', strtotime($item->tgl_bahv)) : '';
        $item->tgl_jt_formatted = $item->tgl_jt ? date('d-m-Y', strtotime($item->tgl_jt)) : '';
        $item->tgl_reg_boa_formatted = $item->tgl_reg_boa ? date('d-m-Y', strtotime($item->tgl_reg_boa)) : '';

        if ($item->tgl_bast) {
            $item->max_tgl_bakb = date('Y-m-d', strtotime($item->tgl_bast . ' +9 days'));
            $item->max_tgl_bakb_formatted = date('d-m-Y', strtotime($item->tgl_bast . ' +9 days'));
            
            if ($item->tgl_bakb) {
                $item->max_tgl_bahv = date('Y-m-d', strtotime($item->tgl_bakb . ' +9 days'));
                $item->max_tgl_bahv_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +9 days'));
            } else {
                $item->max_tgl_bahv = null;
                $item->max_tgl_bahv_formatted = null;
            }
        } else {
            $item->max_tgl_bakb = null;
            $item->max_tgl_bakb_formatted = null;
            $item->max_tgl_bahv = null;
            $item->max_tgl_bahv_formatted = null;
        }

        if ($this->isAlkes($item->jenis_pelayanan)) {
            if ($item->tgl_bahv) {
                $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->tgl_bahv . ' +14 days'));
                $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->tgl_bahv . ' +14 days'));
            } else {
                $item->tgl_jt_calculated = null;
                $item->tgl_jt_calculated_formatted = null;
            }
        } else {
            if ($item->tgl_bakb) {
                $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->tgl_bakb . ' +14 days'));
                $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +14 days'));
            } else {
                $item->tgl_jt_calculated = null;
                $item->tgl_jt_calculated_formatted = null;
            }
        }
    }

    return view('monitoring-sla', compact('pelayanan', 'sortBy', 'sortOrder'));
}

  public function koreksiSla(Request $request)
{
    $query = Pelayanan::query();
    
    $query->whereNotNull('koreksi')
          ->where('koreksi', '>', 0)
          ->whereNotNull('tgl_reg_boa');

    $sortBy = $request->get('sort_by', 'max_tgl_bakb');
    $sortOrder = $request->get('sort_order', 'asc');
    
    if ($sortBy && in_array($sortBy, ['max_tgl_bakb', 'max_tgl_bahv', 'tgl_jt'])) {
        $query->orderBy($sortBy, $sortOrder);
    }
    
    $pelayanan = $query->get();

    foreach ($pelayanan as $item) {
        $item->tgl_bast_formatted = $item->tgl_bast ? date('d-m-Y', strtotime($item->tgl_bast)) : null;
        $item->tgl_bakb_formatted = $item->tgl_bakb ? date('d-m-Y', strtotime($item->tgl_bakb)) : null;
        $item->tgl_bahv_formatted = $item->tgl_bahv ? date('d-m-Y', strtotime($item->tgl_bahv)) : null;
        $item->tgl_jt_formatted = $item->tgl_jt ? date('d-m-Y', strtotime($item->tgl_jt)) : null;
        
        if ($item->tgl_bast) {
            $item->max_tgl_bakb = date('Y-m-d', strtotime($item->tgl_bast . ' +9 days'));
            $item->max_tgl_bakb_formatted = date('d-m-Y', strtotime($item->tgl_bast . ' +9 days'));
            
            if ($item->tgl_bakb) {
                $item->max_tgl_bahv = date('Y-m-d', strtotime($item->tgl_bakb . ' +9 days'));
                $item->max_tgl_bahv_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +9 days'));
            } else {
                $item->max_tgl_bahv = null;
                $item->max_tgl_bahv_formatted = null;
            }
        } else {
            $item->max_tgl_bakb = null;
            $item->max_tgl_bakb_formatted = null;
            $item->max_tgl_bahv = null;
            $item->max_tgl_bahv_formatted = null;
        }

        if ($this->isAlkes($item->jenis_pelayanan)) {
            if ($item->tgl_bahv) {
                $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->tgl_bahv . ' +14 days'));
                $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->tgl_bahv . ' +14 days'));
            } else {
                $item->tgl_jt_calculated = null;
                $item->tgl_jt_calculated_formatted = null;
            }
        } else {
            if ($item->tgl_bakb) {
                $item->tgl_jt_calculated = date('Y-m-d', strtotime($item->tgl_bakb . ' +14 days'));
                $item->tgl_jt_calculated_formatted = date('d-m-Y', strtotime($item->tgl_bakb . ' +14 days'));
            } else {
                $item->tgl_jt_calculated = null;
                $item->tgl_jt_calculated_formatted = null;
            }
        }
    }
    
    return view('pelayanan.koreksi-sla', compact('pelayanan', 'sortBy', 'sortOrder'));
}
    private function isAlkes($jenisPelayanan)
    {
        $alkesList = [
            'Ambulans', 'Korset', 'Collar neck', 'Kantong darah', 'Kruk',
            'Protesa Gigi', 'Imunohistokimia darah', 'CAPD', 'Transfer Set',
            'Kaki Palsu', 'Tangan Palsu', 'Kacamata', 'Alteplase',
            'Alat Bantu Dengar', 'EGFR'
        ];
        
        return in_array($jenisPelayanan, $alkesList);
    }

    public function edit($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak');
        }
   
        $pelayanan->tgl_bast_formatted = $pelayanan->tgl_bast ? date('Y-m-d', strtotime($pelayanan->tgl_bast)) : null;
        $pelayanan->tgl_bakb_formatted = $pelayanan->tgl_bakb ? date('Y-m-d', strtotime($pelayanan->tgl_bakb)) : null;
        $pelayanan->tgl_bahv_formatted = $pelayanan->tgl_bahv ? date('Y-m-d', strtotime($pelayanan->tgl_bahv)) : null;
        $pelayanan->tgl_jt_formatted = $pelayanan->tgl_jt ? date('Y-m-d', strtotime($pelayanan->tgl_jt)) : null;
        
        return view('pelayanan.edit', compact('pelayanan'));
    }

  public function update(Request $request, $id)
{
    if (auth()->user()->role != 'admin') {
        abort(403, 'Akses ditolak');
    }

    $validationRules = [
        'nama_fkrtl' => 'required',
        'bulan_pelayanan' => 'required',
        'jenis_pelayanan' => 'required',
        'jumlah_kasus' => 'required|integer',
        'biaya' => 'required|numeric',
        'kasus_pending' => 'nullable|integer|min:0',
        'biaya_pending' => 'nullable|numeric|min:0',
        'kasus_tidak_layak' => 'nullable|integer|min:0',
        'biaya_tidak_layak' => 'nullable|numeric|min:0',
        'kasus_dispute' => 'nullable|integer|min:0',
        'biaya_dispute' => 'nullable|numeric|min:0',
    ];

    if ($request->jenis_pelayanan === 'Alat Kesehatan') {
        $validationRules['alat_kesehatan'] = 'required';
    }

    $request->validate($validationRules);

    $data = $request->except(['alat_kesehatan']);
    $pelayanan = Pelayanan::findOrFail($id);

    if ($request->jenis_pelayanan === 'Alat Kesehatan') {
        $data['jenis_pelayanan'] = $request->alat_kesehatan;
    } else {
        $data['jenis_pelayanan'] = $request->jenis_pelayanan;
    }

    if ($request->bulan_pelayanan) {
        $data['bulan_pelayanan'] = $request->bulan_pelayanan . '-01';
    }

    if (!empty($data['tgl_bast'])) {
        $data['max_tgl_bakb'] = date('Y-m-d', strtotime($data['tgl_bast'] . ' +9 days'));
    }

    if (!empty($data['tgl_bakb'])) {
        $data['max_tgl_bahv'] = date('Y-m-d', strtotime($data['tgl_bakb'] . ' +9 days'));
    } else {
        $data['max_tgl_bahv'] = null;
    }

    if ($this->isAlkes($data['jenis_pelayanan'])) {
        if (!empty($data['tgl_bahv'])) {
            $data['tgl_jt'] = date('Y-m-d', strtotime($data['tgl_bahv'] . ' +14 days'));
        } else {
            $data['tgl_jt'] = null;
        }
    } else {
        if (!empty($data['tgl_bakb'])) {
            $data['tgl_jt'] = date('Y-m-d', strtotime($data['tgl_bakb'] . ' +14 days'));
        } else {
            $data['tgl_jt'] = null;
        }
    }

    $pelayanan->update($data);

    return redirect()->route('pelayanan.index')
        ->with('success', 'Data berhasil diperbarui.');
}

    public function create(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'finance'])) {
            abort(403, 'Akses ditolak');
        }
        
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

    if (!empty($data['tgl_bast'])) {
        $data['max_tgl_bakb'] = date('Y-m-d', strtotime($data['tgl_bast'] . ' +9 days'));
    }

    if (!empty($data['tgl_bakb'])) {
        $data['max_tgl_bahv'] = date('Y-m-d', strtotime($data['tgl_bakb'] . ' +9 days'));
    } else {
        $data['max_tgl_bahv'] = null;
    }


    if ($this->isAlkes($data['jenis_pelayanan'])) {
        if (!empty($data['tgl_bahv'])) {
            $data['tgl_jt'] = date('Y-m-d', strtotime($data['tgl_bahv'] . ' +14 days'));
        } else {
            $data['tgl_jt'] = null;
        }
    } else {
        if (!empty($data['tgl_bakb'])) {
            $data['tgl_jt'] = date('Y-m-d', strtotime($data['tgl_bakb'] . ' +14 days'));
        } else {
            $data['tgl_jt'] = null;
        }
    }

    Pelayanan::create($data);

    return redirect()->route('pelayanan.index')
        ->with('success', 'Data berhasil ditambahkan.');
}
    public function destroy($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        $pelayanan->delete();

        return redirect()->route('pelayanan.index')
            ->with('success', 'Data berhasil dihapus!');
    }

    public function calculateDates(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya Admin yang bisa mengedit atau menghapus data.');
        }

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

    public function show($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        
        $pelayanan->tgl_bast_formatted = $pelayanan->tgl_bast ? date('d-m-Y', strtotime($pelayanan->tgl_bast)) : null;
        $pelayanan->tgl_bakb_formatted = $pelayanan->tgl_bakb ? date('d-m-Y', strtotime($pelayanan->tgl_bakb)) : null;
        $pelayanan->tgl_bahv_formatted = $pelayanan->tgl_bahv ? date('d-m-Y', strtotime($pelayanan->tgl_bahv)) : null;
        $pelayanan->tgl_jt_formatted = $pelayanan->tgl_jt ? date('d-m-Y', strtotime($pelayanan->tgl_jt)) : null;
        
        return view('pelayanan.show', compact('pelayanan'));
    }

    public function indexView(Request $request)
    {
        $pelayanan = Pelayanan::all();
        return view('pelayanan.index-view', compact('pelayanan'));
    }
}