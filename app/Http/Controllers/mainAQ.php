<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Input;





class mainAQ extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('mainUI/main');
	}

	public function body()
	{
		return view('mainUI/body');
	}

public function test()
	{
		return view('mainUI/test');
	}

	public function lab()
	{
		return view('mainUI/bodylab');
	}


	public function colladaBody()
	{
		return view('mainUI/collada');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function Json_build_ACC_treatment()
	{
		$input = Request::all();
		$json_request=$input;

		$myFile = "json/medi.json";
   		$arr_data = array(); // create empty array

			  try
			  {
				   //Get form data
				   $formdata = array(
				      'x'	=>	 $json_request['x'],
				      'y'	=>	 $json_request['y'],
				      'h'	=> 	 $json_request['h']
				   );

				   $xData=array(
				   	"A"=> $formdata
				   	);
				   //Get data from existing json file
				   $jsondata = file_get_contents($myFile);

				   // converts json data into array
				   $arr_data = json_decode($jsondata, true);

				   // Push user data to array
				   array_push($arr_data,$xData);

			       //Convert updated array to JSON
				   $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
				   
				   //write json data into data.json file
				   if(file_put_contents($myFile, $jsondata)) {
				        echo 'Data successfully saved';
				    }
				   else 
				        echo "Cannot";

			   }
			   catch (Exception $e) {
			            echo 'Caught exception: ',  $e->getMessage(), "\n";
			   }

	}







/*read json from di*/
	public function readJ(){
		$input = Request::all();
		$json_request=$input;

		$myFile = "json/medi.json";
   	

			  try
			  {
				   
				   //Get data from existing json file
				   $jsondata = file_get_contents($myFile);

				   // converts json data into array
				   $arr_data = json_decode($jsondata, true);

					echo  json_encode($arr_data);

			   }
			   catch (Exception $e) {
			            echo 'Caught exception: ',  $e->getMessage(), "\n";
			   }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
