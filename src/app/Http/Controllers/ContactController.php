<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
  {
    return view('index');
  }


    public function confirm(ContactRequest $request)
  {
    
    $contact = $request->only(['lastname', 'firstname', 'gender', 'email', 'postcode', 'address', 'building_name', 'option']);
    $contact['fullname'] = $contact['lastname'] . $contact['firstname'];

    session(['inputItem' => $request->only(['lastname', 'firstname', 'gender', 'email', 'postcode', 'address', 'building_name', 'option'])]);

    
    return view('confirm', compact('contact'));
    
  }


  public function edit()
  {
    $previousInput = session('inputItem', []);

    return view('index', compact('previousInput'));

  }



    public function store(ContactRequest $request)
  {
    $contact = $request->only(['lastname', 'firstname', 'gender', 'email', 'postcode', 'address', 'building_name', 'option']);
    $contact['fullname'] = $contact['lastname'] . $contact['firstname'];
    $contact['gender'] = ($contact['gender'] === '男性') ? 1 : 2;
    Contact::create($contact);

    
    return view('thanks');
  }



}

