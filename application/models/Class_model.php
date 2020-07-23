<?php
class Class_model extends CI_Model {
	
    public function get_all()
    {
        return $this->db->get('classes')->result();
    }

    public function count_subscribers($date, $time)
    {
        $this->db->select('COUNT(class_member.id) as count_subscribers');
        $this->db->from('class_member');
        $this->db->join('classes', 'classes.id = class_member.class_id');
        $this->db->where('date', $date);
        $this->db->where('time', $time);

        return $this->db->get()->result()[0];
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('classes')->result()[0];
    }

    public function am_i_subscribed($date, $time)
    {
        $this->db->select('COUNT(class_member.id) as count');
        $this->db->from('class_member');
        $this->db->join('classes', 'classes.id = class_member.class_id');
        $this->db->where('date', $date);
        $this->db->where('time', $time);
        $this->db->where('member_id', $this->session->userdata('member')->member_id);

        return $this->db->get()->result()[0]->count;
    }

    public function am_i_any_subscribed($date)
    {
        $this->db->select('COUNT(class_member.id) as count');
        $this->db->from('class_member');
        $this->db->where('date', $date);
        $this->db->where('member_id', $this->session->userdata('member')->member_id);

        return $this->db->get()->result()[0]->count;
    }

    public function subscribe_class()
    {
        $class_id = html_escape($this->input->post('class_id'));
        $date = html_escape($this->input->post('date'));

        $class = $this->get_by_id($class_id);
        $count = $this->count_subscribers($date, $class->time)->count_subscribers;

        if ($count >= 8 || $this->am_i_any_subscribed($date)) {
            return false;
        }

        $insert_data = [
            'date' => $date,
            'class_id' => $class_id,
            'member_id' => $this->session->userdata('member')->member_id
        ];

        return $this->db->insert('class_member', $insert_data);
    }

    public function unsubscribe_by_date($date)
    {
        $this->db->where('date', $date);
        $this->db->where('member_id', $this->session->userdata('member')->member_id);

        return $this->db->delete('class_member');
    }
}
