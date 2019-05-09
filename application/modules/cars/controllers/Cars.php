<?php
class Cars extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("cars_model");
    }

    public function index()
    {
        $v_data["car_details"] = $this->cars_model->get_cars();
        $this->load->view("all_cars",$v_data);
    }

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
            $save_details = $this->cars_model->add_car();
            redirect("index");
            //$this->load->view("all_cars", $save_details);
        }
        
        $data["form_error"] = validation_errors();
        $this->load->view("add_car_details", $data);
    }
    // edit button
    // public function edited_friend ()
    // {
    //     $this->form_validation->set_rules ("firstname","First Name","trim|required");
    //     $this->form_validation->set_rules ("age","Age","trim|required|numeric");
    //     $this->form_validation->set_rules ("gender","Gender","trim|required");
    //     $this->form_validation->set_rules ("hobby","Hobby","trim|required");

    //     if ($this->form_validation->run() == FALSE)
    //     {
    //         echo "failed to edit friend";
    //     }
    //     else
    //     {
    //         $friend_id = $this->input->post("friend_id");
    //         $this->friends_model->edit_friend($friend_id);
    //         $this->session->set_flashdata("success_message","Friend ID ".$friend_id." has been edited");
    //     }

    // }

    

    //Function that deletes a car entry by updating delete column to 0
    public function delete_car($car_id)
    {
        //1. load model and pass car_id so as to update the delete column of that particular car entry
        $deleted_car = $this->cars_model->delete_car($car_id);
        //2. Return all cars where the value delete column is 0; meaning, they are not deleted
        redirect("cars/index");
        // $v_data["all_friends"] = $undeleted;
        // // var_dump($v_data);
        // //3. load the all friends view with data from step 2
        
        // $this->load->view("site/layouts/layout", $data);
    }

}
