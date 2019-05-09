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

    public function update_friend($friend_id)
    {
        $data = array(
//how its in db..............how its in form
            "friend_name" => $this->input->post("firstname"),
            "friend_age" => $this->input->post("age"),
            "friend_gender" => $this->input->post("gender"),
            "friend_hobby" => $this->input->post("hobby"),
        );

        $this->db->set($data);
        $this->db->where('friend_id', $friend_id);
        if ($this->db->update('friend')) {
            $this->session->set_flashdata("success","successfuly updated");
        

            return true;
        } else {
            $this->session->set_flashdata("error","failed to update");

            return false;
        }

//var_dump($data);die();
    }
    //end of edit button

    
    
    //Function for deleting a car entry
    public function delete_car($car_id)
    {
        $this->db->where("car_id", $car_id);
        $this->db->set("deleted",0);
        $this->db->update("car_details");
    }   
}
