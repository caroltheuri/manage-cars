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

    public function get_cars()
    {
        $this->db->from("car_details");
        $this->db->order_by("created", "DESC");
        return $this->db->get();
    }

    public function get_all_friends($table, $where, $per_page, $page, $order, $order_method)
    {
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($order, $order_method);
        return $this->db->get("",$per_page,$page);
    }

    public function get_single_friend($friend_id)
    {
        $this->db->where("friend_id", $friend_id);
        return $this->db->get("friend");
    }

    //pagination function
    public function record_count()
    {
        $count = $this->db->count_all_results("friend");
        // var_dump($count);die();
        return $count;
    }
    public function count_items($table, $where)
    {
        $this->db->where($where);
        $count = $this->db->count_all_results($table);
        
        return $count;
    }

    public function fetch_friend($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("friend");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }
    //end of pagination

    //edit button
    //  public function edit_friend($friend_id)
    //  {
    //     $update = array(
    //         "friend_name" => $this->input->post("firstname"),
    //          "friend_age" => $this->input->post("age"),
    //          "friend_gender" => $this->input->post("gender"),
    //          "friend_hobby" => $this->input->post("hobby"),
    //         );
    //     $this->db->where('friend_id',$friend_id);
    //     return $this->db->update('friend', $update);
    //  }

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
        $this->db->where("friend_id", $friend_id);
        $this->db->set("delete",1);
        if($this->db->update("friend"))
        {
           $friends_not_deleted= $this->friends_not_deleted();
           $this->session->set_flashdata("success", "Deleted Successfully");
            return $friends_not_deleted;
        }
        else {
            $this->session->set_flashdata("error","failed to delete");

            return false;
        }
    }   
}
