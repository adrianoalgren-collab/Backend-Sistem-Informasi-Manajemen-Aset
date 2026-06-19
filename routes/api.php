    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\DepartmentController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\ReportController;
    use App\Http\Controllers\ManufacturerController;
    use App\Http\Controllers\AsetOperasionalController;
    use App\Http\Controllers\RequestPerbaikanController;
    use App\Http\Controllers\RequestPengadaanController;
    use App\Http\Controllers\AsetKendaraanController;
    use App\Http\Controllers\AsetBarangPakaiController;
    use App\Http\Controllers\KodeBarangController;


    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Semua route API yang membutuhkan autentikasi menggunakan Sanctum.
    | Route publik: login
    | Route protected: semua CRUD & data yang butuh login
    |
    */

    // ===== PUBLIC ROUTES =====
    Route::post('/login', [AuthController::class, 'login']);

    // ===== PROTECTED ROUTES =====
    Route::middleware('auth:sanctum')->group(function () {

        // ===== AUTH =====
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        // ===== DEPARTMENT =====
        Route::get('/department', [DepartmentController::class, 'index']);         // List semua department
        Route::post('/department', [DepartmentController::class, 'store']);        // Tambah department
        Route::get('/department/{id}', [DepartmentController::class, 'show']);     // Detail department
        Route::put('/department/{id}', [DepartmentController::class, 'update']);   // Update department
        Route::delete('/department/{id}', [DepartmentController::class, 'destroy']);// Hapus department

        // ===== USER =====
        Route::get('/user', [UserController::class, 'index']);                   
        Route::post('/user', [UserController::class, 'store']);                  
        Route::get('/user/{id}', [UserController::class, 'show']);                 
        Route::put('/user/{id}', [UserController::class, 'update']);              
        Route::delete('/user/{id}', [UserController::class, 'destroy']);          

        // ===== ROLE =====
        Route::get('/role', [RoleController::class, 'index']);                     // List semua role
        Route::post('/role', [RoleController::class, 'store']);                    // Tambah role
        Route::get('/role/{id}', [RoleController::class, 'show']);                 // Detail role
        Route::put('/role/{id}', [RoleController::class, 'update']);               // Update role
        Route::delete('/role/{id}', [RoleController::class, 'destroy']);           // Hapus role

        // ===== REPORT =====
        Route::get('/report', [ReportController::class, 'index']);         
        Route::post('/report', [ReportController::class, 'store']);        
        Route::get('/report/{id}', [ReportController::class, 'show']);     
        Route::put('/report/{id}', [ReportController::class, 'update']);    
        Route::delete('/report/{id}', [ReportController::class, 'destroy']);  

        // ===== MANUFACTURER =====
        Route::get('/manufacturer', [ManufacturerController::class, 'index']);         
        Route::post('/manufacturer', [ManufacturerController::class, 'store']);       
        Route::get('/manufacturer/{id}', [ManufacturerController::class, 'show']);     
        Route::put('/manufacturer/{id}', [ManufacturerController::class, 'update']);  
        Route::delete('/manufacturer/{id}', [ManufacturerController::class, 'destroy']); 

        // ===== ASET OPERASIONAL =====
        Route::get('/asetoperasional', [AsetOperasionalController::class, 'index']);         
        Route::post('/asetoperasional', [AsetOperasionalController::class, 'store']);       
        Route::get('/asetoperasional/{id}', [AsetOperasionalController::class, 'show']);    
        Route::put('/asetoperasional/{id}', [AsetOperasionalController::class, 'update']);   
        Route::delete('/asetoperasional/{id}', [AsetOperasionalController::class, 'destroy']); 

        // ===== KODE BARANG =====
        Route::get('/kodebarang', [KodeBarangController::class, 'index']);         
        Route::post('/kodebarang', [KodeBarangController::class, 'store']);        
        Route::get('/kodebarang/{id}', [KodeBarangController::class, 'show']);    
        Route::put('/kodebarang/{id}', [KodeBarangController::class, 'update']);   
        Route::delete('/kodebarang/{id}', [KodeBarangController::class, 'destroy']); 
        // routes/api.php — taruh SEBELUM apiResource
        Route::get('/kodebarang/check',    [KodeBarangController::class, 'checkKode']);
        Route::get('/kodebarang/next',     [KodeBarangController::class, 'nextKode']);   // ← baru
        Route::apiResource('/kodebarang',  KodeBarangController::class);

        // ===== ASET BARANG PAKAI =====
        Route::get('/asetbarangpakai', [AsetBarangPakaiController::class, 'index']);         // List semua aset barang pakai
        Route::post('/asetbarangpakai', [AsetBarangPakaiController::class, 'store']);         // Tambah aset barang pakai
        Route::get('/asetbarangpakai/{id}', [AsetBarangPakaiController::class, 'show']);      // Detail aset barang pakai
        Route::put('/asetbarangpakai/{id}', [AsetBarangPakaiController::class, 'update']);    // Update aset barang pakai
        Route::delete('/asetbarangpakai/{id}', [AsetBarangPakaiController::class, 'destroy']); // Hapus aset barang pakai

        // ===== Request Perbaikan =====
        Route::get('/request/perbaikan', [RequestPerbaikanController::class, 'index']);         
        Route::post('/request/perbaikan', [RequestPerbaikanController::class, 'store']);       
        Route::get('/request/perbaikan/{id}', [RequestPerbaikanController::class, 'show']);     
        Route::put('/request/perbaikan/{id}', [RequestPerbaikanController::class, 'update']);   
        Route::delete('/request/perbaikan/{id}', [RequestPerbaikanController::class, 'destroy']); 

        // ===== Request Pengadaan =====
        Route::get('/request/pengadaan', [RequestPengadaanController::class, 'index']);         
        Route::post('/request/pengadaan', [RequestPengadaanController::class, 'store']);       
        Route::get('/request/pengadaan/{id}', [RequestPengadaanController::class, 'show']);     
        Route::put('/request/pengadaan/{id}', [RequestPengadaanController::class, 'update']);   
        Route::delete('/request/pengadaan/{id}', [RequestPengadaanController::class, 'destroy']); 

        // ===== ASET KENDARAAN =====
        Route::get('/asetkendaraan', [AsetKendaraanController::class, 'index']);        
        Route::post('/asetkendaraan', [AsetKendaraanController::class, 'store']);        
        Route::get('/asetkendaraan/{id}', [AsetKendaraanController::class, 'show']);     
        Route::put('/asetkendaraan/{id}', [AsetKendaraanController::class, 'update']); 
        Route::delete('/asetkendaraan/{id}', [AsetKendaraanController::class, 'destroy']); 
        Route::get('/asetkendaraan/{id}/history', [AsetKendaraanController::class, 'history']);
        
    });