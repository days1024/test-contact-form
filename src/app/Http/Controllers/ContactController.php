<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
public function index()
  {
     $categories = Category::pluck('content','id');

    return view('index',compact('categories'));
}


public function confirm(ContactRequest $request)
  {

     $contact = $request->only(['first_name', 'last_name', 'email', 'gender','tel','address','building','contact_type','detail','category_id']);


    $contact['tel_display'] = implode($request->tel);
    $categories = Category::pluck('content','id');
    return view('confirm', compact('contact' ,'categories'));
}
 

public function thanks(ContactRequest $request)
  {

    if ($request->action === 'back') {
     return redirect('/')->withInput();
    }

     $contact = $request->only(['first_name', 'last_name', 'email', 'gender','tel','address','building','detail','category_id']);
    $contact['tel'] = implode($request->tel);
     Contact::create($contact);
    return view('thanks');
    
    
}


public function admin()
  {
     $contacts = Contact::with('category')->paginate(7);
     $categories = Category::all();
    return view('admin', compact('contacts','categories'));
}

public function search(Request $request)
  {

     $contacts = Contact::with('category')->CategorySearch($request->category_id, $request->gender, $request->birthdate)->KeywordSearch($request->keyword)->paginate(7);
     $categories = Category::all();
     return view('admin', compact('contacts', 'categories'));

}

public function delete(Request $request)
{
  Contact::find($request->id)->delete();

  return redirect('/admin');
}

public function reset()
{
    return redirect('/admin');
}


public function export(Request $request)
{
    $contacts = Contact::with('category')
        ->keywordSearch($request->keyword)
        ->categorySearch(
            $request->category_id,
            $request->gender,
            $request->birthdate
        )
        ->get();

    return response()->streamDownload(function () use ($contacts) {

        $handle = fopen('php://output', 'w');

        fputcsv($handle, [
            '姓',
            '名',
            '性別',
            'メールアドレス',
            'お問い合わせ種類',
            '作成日'
        ]);

        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->last_name,
                $contact->first_name,
                $genderLabels[$contact->gender] ?? '',
                $contact->email,
                $contact->category->content ?? '',
                $contact->created_at,
            ]);
        }

        fclose($handle);

    }, 'contacts.csv');
}
}



