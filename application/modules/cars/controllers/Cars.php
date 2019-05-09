<?php
class Cars extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("cars_model");
    }

    //Function that displays all records
    public function index()
    {
        $v_data["car_details"] = $this->cars_model->get_cars();
        $this->load->view("all_cars",$v_data);
        // echo json_encode($v_data);
        // echo json_decode($v_data);


    }

    //Function that sorts by Blue color
    public function sortColor(){
        $v_data["car_details"]= $this->cars_model->sort_by_color();
        $this->load->view("all_cars",$v_data);    }

    //Function for adding a new entry
    /**
     * If an entry is successful an success alert will be shown and the viceversa if it fails to save successfully
     * Whether successful or not it will redirect to the landing page, but if there is a problem with the input you will be redirected to the same page
     */
    public function add_car()
    {
        $this->form_validation->set_rules("carmake", "Car Make", "required");
        $this->form_validation->set_rules("color", "Color", "required");
        $this->form_validation->set_rules("registrationnumber", "Registration Number", "required");
        $this->form_validation->set_rules("year", "Year", "required");
        $this->form_validation->set_rules("cartype", "Car Type", "required");
        $this->form_validation->set_rules("availability", "Availability", "required");

        if ($this->form_validation->run()) {
            $color = $this->input->post("color");
            if(($color == "Blue") || ($color == "Red") || ($color == "Green") || ($color == "White") || ($color == "Yellow")){
                $save_details = $this->cars_model->add_car();
            }
            //$save_details = $this->cars_model->add_car();
            redirect("cars/index");
            //$this->load->view("all_cars", $save_details);
        }
        
        $data["form_error"] = validation_errors();
        $this->load->view("add_car_details", $data);
    }
    // Function for editing car details
     public function update_car($car_id)
    {
       
        $this->form_validation->set_rules("color", "Color", "required");
        $this->form_validation->set_rules("availability", "Availability", "required");

        if ($this->form_validation->run()) {
            $update_details = $this->cars_model->update_car($car_id);
            
            redirect("cars/index");
        }
        $single_car = $this->cars_model->single_car($car_id);
        if ($single_car->num_rows() > 0) {
            $row = $single_car->row();
            $id = $row->car_id;
            $car_make = $row->car_make;
            $color = $row->color;
            $registration_number = $row->registration_number;
            $year_of_manufuctring = $row->year_of_manufuctring;
            $car_type = $row->car_type;
            $availability = $row->availability;
        }
        $v_data = array(
            "id" => $id ,
            "car_make" => $car_make, 
            "color" => $color,
            "registration_number" => $registration_number,
            "year_of_manufuctring" => $year_of_manufuctring,
            "car_type" => $car_type,
            "availability" => $availability
        );

        $data["form_error"] = validation_errors();
        $this->load->view("edit_cardetails", $v_data);

    }

    

    //Function that deletes a car entry by updating delete column to 0
    public function delete_car($car_id)
    {
        //1. load model and pass car_id so as to update the delete column of that particular car entry
        $deleted_car = $this->cars_model->delete_car($car_id);
        //2. Return all cars where the value delete column is 0; meaning, they are not deleted
        redirect("cars/index");
    }
    public function activate($car_id){
         $activate = $this->cars_model->activate($car_id);
         redirect("cars/index");
    }
    public function deactivate($car_id){
        $deactivate = $this->cars_model->deactivate($car_id);
        redirect("cars/index");
    }
    public function people()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://swapi.co/api/people/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
        echo "cURL Error #:" . $err;
        } else 
        {
            $array = json_decode($response, true);
            $total_people = $array["results"];
            if(is_array($array)){
                for($j=0;$j<count($array["results"]);$j++) {
                    $url = $array["results"][$j]["url"];
                    $name = $array["results"][$j]["name"];
                    $eyecolor = $array["results"][$j]["eye_color"];
                    $birthyear = $array["results"][$j]["birth_year"];
                    $height = $array["results"][$j]["height"];
                    $gender = $array["results"][$j]["gender"];

                    //echo $url;
                    if (strpos($url,'1') !== false) {
                        $save_people_details = $this->cars_model->save_people_details($name,$eyecolor,$birthyear);
                    }
                    if($eyecolor == "blue"){
                        $save_blue_people_details = $this->cars_model->save_blue_people_details($name,$height,$gender);
                    }
                }
            }  
        }
    }
}
