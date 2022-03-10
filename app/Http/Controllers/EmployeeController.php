<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::leftJoin('countries','countries.id','employees.country_id')
        ->leftJoin('states','states.id','employees.state_id')
        ->leftJoin('cities','cities.id','employees.city_id')
        ->select('employees.*','countries.name as country','states.name as state','cities.name as city')
        ->get();
        return $data;
    }
    public function loadCountry()
    {
        return Country::get();
    }
    public function loadState()
    {
        return State::get();
    }
    public function loadCity()
    {
        return City::get();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_number' => 'required|digits:10',
            'address_line1' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'image' => 'required',
        ]);

        $emp_image = $request['image'];
        $emp_image = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        $img = \Image::make($request->image);
        $img->save('images/employee/'.$emp_image);

        Employee::create([
            'country_id'=> $request['country'],
            'state_id'=> $request['state'],
            'city_id'=> $request['city'],
            'image'=> $emp_image,
            'name'=> $request['name'],
            'email'=> $request['email'],
            'mobile_number'=> $request['mobile_number'],
            'address_line1'=> $request['address_line1'],
            'address_line2'=> $request['address_line2'],
        ]);

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
        //
    }
}
