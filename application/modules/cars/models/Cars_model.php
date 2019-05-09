<?php
class Cars_model extends CI_Model
{
    //Function that saves entries to the database in the car_details table.
    function add_car()
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
        if ($this->db->insert("car_details", $data)) {
            $this->session->set_flashdata("success", "New Car has been added");
            return $this->db->insert_id();
        } else {
            $this->session->set_flashdata("error", "New friend cannot be added");
            return false;
        }

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
            "car_make" => $this->input->post("carmake"),
            "color" => $this->input->post("color"),
            "registration_number" => $this->input->post("registrationnumber"),
            "year_of_manufuctring" => $this->input->post("year"),
            "car_type" => $this->input->post("cartype"),
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
        $this->db->where("car_id", $car_id);
        $this->db->set("deleted",0);
        $this->db->update("car_details");
    }  
    
    //Function that returns cars whose colour is blue alone
    public function sort_by_color()
    {
        $this->db->where("color", "Blue");
        $this->db->get("car_details");
    }  
}
