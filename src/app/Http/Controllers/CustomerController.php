<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Customer;


class CustomerController extends Controller
{

    public function index()
{
    $contacts = Contact::Paginate(10);

    return view('customer', compact('contacts'));
}


    public function search(Request $request)
{
    $fullname = $request->input('fullname');
    $gender = $request->input('gender');
    $from = $request->input('from');
    $until = $request->input('until');
    $email = $request->input('email');

    $query = Contact::query();

    
    if ($fullname) {
    $fullname = '%' . $fullname . '%';
    $query->whereRaw("replace(fullname, ' ', '') like ?")
        ->orWhereRaw("replace(fullname, '　', '') like ?", [$fullname, $fullname]);
    }

   
    if ($gender) {
        if ($gender === '男性') {
            $query->where('gender', '1');
        } elseif ($gender === '女性') {
            $query->where('gender', '2');
        } elseif ($gender === '全て') {
            $query->where(function ($query) {
                $query->whereIn('gender', ['1', '2']);
            });
    }
    }

    if (isset($from) && isset($until)) {
    $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=', $until);
    }

    if ($email) {
        $query->where('email', 'like', '%' . $email . '%');
    }

    $contacts = $query->with('customer')->paginate(10);

    return view('customer', compact('contacts'));
}


    public function reset()
{
    $contacts = Contact::Paginate(10);

    return view('customer', compact('contacts'));

}

    public function destroy(Request $request)
{
    Contact::find($request->id)->delete();
    return redirect('/customer');
}


}
