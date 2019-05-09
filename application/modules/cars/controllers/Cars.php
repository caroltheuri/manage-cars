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
        $car_details = $this->cars_model->get_cars();
        $this->load->view("all_cars",$car_details);
    }

    public function welcome($friend_id)
    {
        $my_friend = $this->friends_model->get_single_friend($friend_id);
        if ($my_friend->num_rows() > 0) {
            $row = $my_friend->row();
            $friend = $row->friend_name;
            $age = $row->friend_age;
            $gender = $row->friend_gender;
            $hobby = $row->friend_hobby;

            //form validation

            // $this->form_validation->set_rules
            //("firstname","First Name","required");
            //$this->form_validation->set_rules
            // ("age","Age","required|numeric");
            // $this->form_validation->set_rules
            // ("gender","Gender","required");
            // $this->form_validation->set_rules
            //("hobby","Hobby","required");

            // if($this->form_validation->run())
            // {
            // $friend = $this->input->post("firstname");
            // $age = $this->input->post("age");
            // $gender = $this->input->post("gender");
            //  $hobby = $this->input->post("hobby");

            //}else{
            //    $validation_errors = validation_errors();

            // }

            $data = array(
                "friend_name" => $friend,
                "friend_age" => $age,
                "friend_gender" => $gender,
                "friend_hobby" => $hobby,

            );

            //  $v_data ["welcome_here"]= "friends/Friends_model";
            // $data = array("title" => $this->site_model->display_page_title(),
            //     "content" => $this->load->view("friends/welcome_here", $v_data, true),

            // );
            // $this->load->view("site/layouts/layout", $data);

            $this->load->view("welcome_here", $data);
        } else {
            $this->session->set_flashdata("error_message", "could not find your friend");
            redirect("hello");

        }
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
            $this->load->view("all_cars", $save_details);
        }
        else{
            $data["form_error"] = validation_errors();

            $this->load->view("add_car_details", $data);

        }
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

    //function to display the edit form

    public function display_edit_form($friend_id)
    {
        $this->form_validation->set_rules("firstname", "First Name", "required");
        $this->form_validation->set_rules("age", "Age", "required|numeric");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("hobby", "Hobby", "required");

        //if the edit form is submitted do this
        if ($this->form_validation->run()) {
            $friend_id = $this->friends_model->update_friend($friend_id);
            redirect("friends");
        } else {
            $validation_errors = validation_errors();
            if (!empty($validation_errors)) {
                $this->session->set_flashdata("error", $validation_errors);
            }
        }

        //1. get data for the friend with the passed friend_id from the model

        $single_friend_data = $this->friends_model->get_single_friend($friend_id);
        if ($single_friend_data->num_rows() > 0) {
            $row = $single_friend_data->row();
            $friend_id = $row->friend_id;
            $friend_name = $row->friend_name;
            $friend_age = $row->friend_age;
            $friend_gender = $row->friend_gender;
            $friend_hobby = $row->friend_hobby;
        }
        $v_data = array(
            "friend_id" => $friend_id,
            "friend_name" => $friend_name,
            "friend_age" => $friend_age,
            "friend_gender" => $friend_gender,
            "friend_hobby" => $friend_hobby,

        );

        //2. Load view with the data from step 1
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("friends/edit_friend", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
    }

    //delete function whereby we are updating detete column to 1
    public function delete_friend($friend_id)
    {
        //1. load model and pass friend_id so as to update the delete column of that particular friend
        $undeleted = $this->friends_model->remove_friend($friend_id);
        //2. Return all friends where the value delete column is 0; meaning, they are not deleted

        $v_data["all_friends"] = $undeleted;
        // var_dump($v_data);
        //3. load the all friends view with data from step 2
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("friends/all_friends", $v_data, true),
        );

        $this->load->view("site/layouts/layout", $data);
    }

}
