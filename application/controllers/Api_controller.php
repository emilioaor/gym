<?php
class Api_controller extends CI_Controller {

    public function login_user()
    {
        $data = json_decode($this->input->raw_input_stream, true);

        $user_id = $this->register_user_model->login_by_email_or_phone($data['useremail'], $data['userpassword']);
        $this->register_user_model->set('user_id',$user_id);
        $data = $this->register_user_model->get_user();

        if(!empty($data))
        {
            foreach ($data as $value) {
                $sess_data = array(
                    'id'           => $value->user_id,
                    'username'     => $value->first_name,
                    'role' => $value->role,
                    'email' => $value->user_email,
                    'member' => $this->members_model->get_by_email($value->user_email)
                );
            }
        }

        if($user_id !== false) {

            if ($sess_data['role'] === 'admin') {
                echo json_encode(['success' => false]);
            } else {
                echo json_encode(['success' => true, 'data' => $sess_data]);
            }

        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function refresh_login()
    {
        $data = json_decode($this->input->raw_input_stream, true);
        $user_id = $data['user_id'];

        $this->register_user_model->set('user_id', $user_id);
        $data = $this->register_user_model->get_user();

        if(!empty($data))
        {
            foreach ($data as $value) {
                $sess_data = array(
                    'id'           => $value->user_id,
                    'username'     => $value->first_name,
                    'role' => $value->role,
                    'email' => $value->user_email,
                    'member' => $this->members_model->get_by_email($value->user_email)
                );
            }
        }

        if($user_id !== false) {

            if ($sess_data['role'] === 'admin') {
                echo json_encode(['success' => false]);
            } else {
                echo json_encode(['success' => true, 'data' => $sess_data]);
            }

        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function time_to_next_class()
    {
        echo json_encode(['success' => true, 'data' => $this->class_model->timeToNextClass()]);
    }

    public function class_today()
    {
        $data = json_decode($this->input->raw_input_stream, false);
        $this->session->set_userdata([
            'id' => $data->user->id,
            'username' => $data->user->username,
            'role' => $data->user->role,
            'email' => $data->user->email,
            'member' => $data->user->member,
        ]);

        echo json_encode(['success' => true, 'data' => $this->class_model->class_today()]);
    }

    public function subscribe_class()
    {
        $data = json_decode($this->input->raw_input_stream, false);
        $this->session->set_userdata([
            'id' => $data->user->id,
            'username' => $data->user->username,
            'role' => $data->user->role,
            'email' => $data->user->email,
            'member' => $data->user->member,
        ]);
        $res = $this->class_model->subscribe_class($data->class_id, $data->date);

        if ($res) {
            echo json_encode(['success' => true, 'data' => $res]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function unsubscribe_by_date()
    {
        $data = json_decode($this->input->raw_input_stream, false);
        $this->session->set_userdata([
            'id' => $data->user->id,
            'username' => $data->user->username,
            'role' => $data->user->role,
            'email' => $data->user->email,
            'member' => $data->user->member,
        ]);
        $res = $this->class_model->unsubscribe_by_date($data->date);

        if ($res) {
            echo json_encode(['success' => true, 'data' => $res]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function update_firebase_token()
    {
        $data = json_decode($this->input->raw_input_stream, true);

        $res = $this->register_user_model->update_firebase_token($data->class_id, $data->date);

        if ($res) {
            echo json_encode(['success' => true, 'data' => $res]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
