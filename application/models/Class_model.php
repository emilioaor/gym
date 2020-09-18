<?php
class Class_model extends CI_Model {



    public function get_all()
    {
        return $this->db->get('classes')->result();
    }

    public function get_actives()
    {
        $this->db->where('status', 'active');

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

    public function get_subscribers($date, $time)
    {
        $this->db->select('member_reg.*');
        $this->db->from('class_member');
        $this->db->join('classes', 'classes.id = class_member.class_id');
        $this->db->join('member_reg', 'member_reg.member_id = class_member.member_id');
        $this->db->where('date', $date);
        $this->db->where('time', $time);

        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('classes')->result()[0];
    }

    public function am_i_subscribed($date, $time)
    {
        $member_id = $this->session->userdata('role') === 'member' ? $this->session->userdata('member')->member_id : 0;

        $this->db->select('COUNT(class_member.id) as count');
        $this->db->from('class_member');
        $this->db->join('classes', 'classes.id = class_member.class_id');
        $this->db->where('date', $date);
        $this->db->where('time', $time);
        $this->db->where('member_id', $member_id);

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

    public function subscribe_class($class_id = null, $date = null)
    {
        if (! $class_id && ! $date) {
            $class_id = html_escape($this->input->post('class_id'));
            $date = html_escape($this->input->post('date'));
        }

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

    public function class_today()
    {
        $cls = $this->get_actives();
        $now = new \DateTime();
        $from = $now->format('H:00:00');
        $tomorrow = new \DateTime('+1 day');
        $to = $tomorrow->format('H:00:00');
        $classes = [];
        $subscribedDates = [];
        $expDate = $this->session->userdata('role') === 'member' ?
            $this->session->userdata('member')->member_exp_date :
            (new \DateTime('+1 year'))->format('Y-m-d')
        ;

        foreach ($cls as $class) {
            // Todas las clases de hoy
            $class->date = $now->format('Y-m-d');
            $class->date_f = $now->format('d M');
            $class->subscribed = $this->am_i_subscribed($class->date, $class->time);

            if ($class->subscribed || ($class->time >= $from && $now->format('Y-m-d') <= $expDate)) {
                $class->members = $this->get_subscribers($class->date, $class->time);
                $class->count_subscribers = count($class->members);
                if ($class->subscribed) {
                    $subscribedDates[] = $class->date;
                }

                $classes[] = clone $class;
            }
        }
        foreach ($cls as $class) {
            // Clases que no superen las 24 horas
            if ($class->time <= $to && $tomorrow->format('Y-m-d') <= $expDate) {
                $class->date = $tomorrow->format('Y-m-d');
                $class->date_f = $tomorrow->format('d M');
                $class->members = $this->get_subscribers($class->date, $class->time);
                $class->count_subscribers = count($class->members);
                $class->subscribed = $this->am_i_subscribed($class->date, $class->time);
                if ($class->subscribed) {
                    $subscribedDates[] = $class->date;
                }

                $classes[] = clone $class;
            }
        }

        return [
            'classes' => $classes,
            'date' => $now->format('Y-m-d'),
            'time' => $from,
            'oneHourBefore' => $now->modify('+1 hour')->format('H:00:00'),
            'subscribed_dates' => $subscribedDates
        ];
    }

    public function save_setting()
    {
        foreach ($this->input->post('classes') as $id => $class) {
            $id = html_escape($id);
            $data = [
                'time' => html_escape($class['time']),
                'status' => html_escape($class['status'])
            ];

            $this->db->where('id', $id);
            $this->db->update('classes', $data);
        }

        return true;
    }

    public function subscribers_by_date_range($from, $to)
    {
        $this->db->select('class_id, date, COUNT(id) as count');
        $this->db->from('class_member');
        $this->db->where('date >=', $from);
        $this->db->where('date <=', $to);
        $this->db->group_by('class_id, date');

        $subscribers = $this->db->get()->result();
        $classes = $this->get_all();
        $subscribersByDate = [];

        $from = new \DateTime($from);
        $to = new \DateTime($to);

        while ($from <= $to) {
            foreach ($classes as $class) {

                $count = 0;
                foreach ($subscribers as $subscriber) {
                    if ($subscriber->class_id === $class->id && $from->format('Y-m-d') === $subscriber->date) {
                        $count = $subscriber->count;
                        break;
                    }
                }

                $subscribersByDate[] = [
                    'class_id' => $class->id,
                    'date' => $from->format('Y-m-d'),
                    'time' => $class->time,
                    'count' => $count
                ];
            }

            $from->modify('+1 day');
        }

        return $subscribersByDate;
    }

    public function timeToNextClass()
    {
        $now = new \DateTime();
        $time = $now->format('H:m:00');

        $this->db->where('time >', $time);
        $this->db->order_by('time');
        $this->db->limit(1);

        $classes = $this->db->get('classes')->result();

        if (count($classes) > 0) {

            $time = explode(':', $classes[0]->time);
            $date = (new \DateTime())->setTime($time[0], 0, 0);

        } else {
            $this->db->order_by('time');
            $this->db->limit(1);
            $classes = $this->db->get('classes')->result();

            $time = explode(':', $classes[0]->time);
            $date = (new \DateTime('+1 day'))->setTime($time[0], 0, 0);
        }

        $diff = $now->diff($date);

        return [
            'h' => $diff->h,
            'i' => $diff->i,
            's' => $diff->s
        ];
    }
}
