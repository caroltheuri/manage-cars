<?php
class Cars_model extends CI_Model
{
    //Function that saves entries to the database in the car_details table.
    public function add_car()
    {
        $data = array(
            "car_make" => $this->input->post("carmake"),
            "color" => $this->input->post("color"),
            "registration_number" => $this->input->post("registrationnumber"),
            "year_of_manufuctring" => $this->input->post("year"),
            "car_type" => $this->input->post("cartype"),
            "availability" => $this->input->post("availability"),
            "date_created" => date('Y-m-d H:i:s'),
            "deleted" => "1"

        );
        $this->db->insert("car_details", $data);
        return $this->db->insert_id();

    }

    //This function retrieves all car entries where records are not deleted
    public function get_cars()
    {
        $this->db->from("car_details");
        $this->db->where("deleted",1);
        $this->db->order_by("date_created", "DESC");
        return $this->db->get();
    }

    //Function that updates car entries
    public function update_car($car_id)
    {
        $data = array(
            
            "color" => $this->input->post("color"),
            "availability" => $this->input->post("availability"),
            "date_updated" => date('Y-m-d H:i:s'),

        );
        $this->db->set($data);
        $this->db->where('car_id', $car_id);
        $this->db->update('car_details');
    }   

    //Function that gets details of a single car

    public function single_car($car_id)
    {
        $this->db->where('car_id', $car_id);
        return $this->db->get('car_details');
    }
    
    //Function for deleting a car entry
    public function delete_car($car_id)
    {
        $data = array(
            "car_id"=> $car_id,
            "availability" => 0
        );
        $this->db->where($data);
        $this->db->set("deleted",0);
        $this->db->update("car_details");
    }  
    
    public function activate($car_id){
        $this->db->where("car_id", $car_id);
        $this->db->set("availability",1);
        $this->db->update("car_details");
    }
    public function deactivate($car_id){
        $this->db->where("car_id", $car_id);
        $this->db->set("availability",0);
        $this->db->update("car_details");
    }
    //Function that returns cars whose colour is blue alone
    public function sort_by_color()
    {
        $this->db->where("color", "Blue");
        return $this->db->get("car_details");
    }  
    //Function that saves peoples details with id of 1
    public function save_people_details($name,$eyecolor,$birthyear){
        $data = array(
            "name" => $name,
            "eye_color" => $eyecolor,
            "birth_year" => $birthyear
        );
        $this->db->insert("people_details", $data);
    }
    //Function that saves people with the eye color blue
    public function save_blue_people_details($name,$height,$gender){
        $data = array(
            "name" => $name,
            "height" => $height,
            "gender" => $gender
        );
        if(($name == "n/a") || ($height == "n/a") || ($gender == "n/a")){
            $name = "hidden";
            $height = "hidden";
            $gender = "hidden";
        }
        $this->db->insert("blue_people", $data);
    }
}
