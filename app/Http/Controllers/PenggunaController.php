<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\ref_unit;
use App\Models\ref_peranan_pengguna;
use App\Models\user_role_pengguna;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\user_tajuk_mesyuarat;
use App\Models\Log_Aktiviti;


class PenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = User::All();

        $user_tajuk_mesyuarat = user_tajuk_mesyuarat::All();
        // dd($ref_tajuk_mesyuarat);

        $user_role_pengguna = user_role_pengguna::All();
        //  dd($user_role_pengguna);

        return view('penyelenggaraan.p_Pengguna')->with(compact('users', 'user_tajuk_mesyuarat', 'user_role_pengguna'));
    }

    public function show(User $users, $id)
    {
        // $users=User::where($id)->firstOrFail();
        $user = User::find($id);
        // dd($users);

        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::orderBy('id_tajuk', 'ASC')
            ->whereNotIn('id_tajuk', [2, 3, 4, 6, 7, 8, 9, 10])
            ->get();

        $role_pengguna = user_role_pengguna::join('users', 'users.id', '=', 'user_role_pengguna.id_user')
            ->get();

        $tajuk_mesyuarat = user_tajuk_mesyuarat::join('users', 'users.id', '=', 'user_tajuk_mesyuarat.id_user')
            ->get();

        // $users=User::All();
        return view('penyelenggaraan.p_paparPengguna')->with(compact('user'));
    }

    public function edit(User $users, $id)
    {
        $user = User::find($id); // User::findOrFail($id);
        // dd($users);

        $ref_unit = ref_unit::All();

        $ref_peranan_pengguna = ref_peranan_pengguna::All();

        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::orderBy('id_tajuk', 'ASC')
            ->whereNotIn('id_tajuk', [2, 3, 4, 6, 7, 8, 9, 10])
            ->get();

        $user_role_pengguna = user_role_pengguna::where('id_user', $id)
            ->get();

        $user_tajuk_mesyuarat = user_tajuk_mesyuarat::where('id_user', $id)
            ->get();


        return view('penyelenggaraan.p_editPengguna')->with(compact('user', 'ref_unit', 'ref_peranan_pengguna', 'ref_tajuk_mesyuarat', 'user_role_pengguna', 'user_tajuk_mesyuarat'));
    }

    public function update(Request $request, string $id, User $usr)
    {
        $user = User::where('id', '=', $id)
            ->firstOrFail();
        $original   = $user->getOriginal();

        $data = $request->all();
        $user->updated_by = Auth::User()->name;
        $user->update($data);

        // Get the array of new data from the request
        $tajuk_mesyuarat = $request->get('tajuk_mesyuarat');

        // Update the relationship between the User model and user_tajuk_mesyuarat model using sync
        $user->refTajuks()->sync($tajuk_mesyuarat);

        // Manually update the timestamps for each pivot record
        $now = now(); // Get the current timestamp

        foreach ($tajuk_mesyuarat as $id_tajuk) {
            $pivotColumns = [
                'created_at' => $now,
                'updated_at' => $now,
                'updated_by' => $user->updated_by = Auth::User()->name,
            ];

            $user->refTajuks()->updateExistingPivot($id_tajuk, $pivotColumns);
        }

        // Get the array of new data from the request
        $role_pengguna  = $request->get('role_pengguna');

        // Update the relationship between the User model and user_role_pengguna model using sync
        $user->refPeranans()->sync($role_pengguna);

        // Manually update the timestamps for each pivot record
        $now = now(); // Get the current timestamp

        foreach ($role_pengguna as $id_peranan) {
            $pivotColumns = [
                'created_at' => $now,
                'updated_at' => $now,
                'updated_by' => $user->updated_by = Auth::User()->name,
            ];

            $user->refPeranans()->updateExistingPivot($id_peranan, $pivotColumns);
        }

        $name = $user->name;

        $changes    =   $user->getChanges();
        Log_Aktiviti::create([
            'module_id'     => json_encode($user->id),
            'module_type'   => class_basename(get_class($usr)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return redirect()->route('p_pengurusanPengguna')
            ->with('status', "Maklumat penggguna: $name telah dikemaskini")
            ->with(compact('user'));
    }

    public function softDelete($id, Request $request, User $usr)
    {
        $user = User::where('id', '=', $id)
            ->firstOrFail();
        $original   = $user->getOriginal();

        $user->delete();
        $user->deleted_by = Auth::user()->name;
        $user->update();
        $changes    =   $user->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($user->id),
            'module_type'   => class_basename(get_class($usr)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        $name = $user->name;

        return redirect()->back()->with('status', "Rekod $name telah berjaya dihapuskan.");
    }

    public function edit_password_pengguna_admin($id)
    {
        $user = User::where('id', '=', $id)
            ->firstOrFail();

        return view('penyelenggaraan.reset_password_admin')->with(compact('user'));
    }

    public function update_password_pengguna_admin($id, Request $request, User $usr)
    {
        $user = User::where('id', '=', $id)
            ->firstOrFail();
        $original   = $user->getOriginal();

        $request->validate(
            [
                'password' => ['required', 'string', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
            ]
        );

        $user->password = Hash::make($request->get('password'));
        $user->update();

        $changes    =   $user->getChanges();
        Log_Aktiviti::create([
            'module_id'     => json_encode($user->id),
            'module_type'   => class_basename(get_class($usr)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        $name = $user->name;

        return redirect()->route('p_pengurusanPengguna')
            ->with('status', "Password penggguna: $name telah dikemaskini")->with(compact('user'));
    }

    public function edit_password_pengguna($id)
    {
        $user = Auth::user();

        return view('penyelenggaraan.reset_password')->with(compact('user'));
    }

    public function update_password_pengguna($id, Request $request, User $usr)
    {
        /*
    *  if funnction that check if the current password is the same as the value in the database
    *  if the password is different it will not change and show an error
    */
        if (!(Hash::check($request->get('current_password'), Auth::User()->password))) {
            // dd($request);
            return back()
                ->withErrors(['current_password' => ["Kata Laluan lama tidak sama"]]);
        }

        /*
    *  if funnction that check if the current password is the same as the value in the database
    *  if the password is same it will show that the password cannot be the same value as the old pasword
    */
        if (strcmp($request->get('current_password'), $request->get('password')) == 0) {
            return back()
                ->withErrors(['password' => ["Kata Laluan lama tidak boleh sama dengan Kata Laluan baru"]]);
        }

        /*
    *  if funnction that check if the password is the same as the previous value
    *  if the password is same it will show that the password is not the same as the previous value
    */

        if (strcmp($request->get('password'), $request->get('password_confirmation')) != 0) {
            return back()
                ->withErrors(['password_confirmation' => ["Kata Laluan tidak sama dengan kata Laluan baru"]]);
        }

        /*
    *  if the old password is check and the value is same as in databse and new password is different value
    *  it will add the new password to the database
    */

        $user = User::where('id', '=', $id)
            ->firstOrFail();
        $original   = $user->getOriginal();

        $request->validate(
            [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );

        $user->password = Hash::make($request->get('password'));
        $user->update();

        $changes    =   $user->getChanges();
        Log_Aktiviti::create([
            'module_id'     => json_encode($user->id),
            'module_type'   => class_basename(get_class($usr)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return redirect()->route('home')->with('status', "Kata laluan telah dikemaskini")->with(compact('user'));
    }
}
