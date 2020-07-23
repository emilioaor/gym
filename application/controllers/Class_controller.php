<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Class_controller extends CI_Controller {
    

	public function index()
    {
        $data['main_view'] = "member_classes_view";

        $cls = $this->class_model->get_all();
        $now = new \DateTime();
        $from = $now->format('H:00:00');
        $tomorrow = new \DateTime('+1 day');
        $to = $tomorrow->format('H:00:00');
        $classes = [];
        $anySubscribed = false;
        foreach ($cls as $class) {
            // Todas las clases de hoy
            if ($class->time >= $from) {
                $class->date = $now->format('Y-m-d');
                $class->count_subscribers = $this->class_model->count_subscribers($class->date, $class->time)->count_subscribers;
                $class->subscribed = $this->class_model->am_i_subscribed($class->date, $class->time);
                if ($class->subscribed) {
                    $anySubscribed = true;
                }

                $classes[] = clone $class;
            }
        }
        foreach ($cls as $class) {
            // Clases que no superen las 24 horas
            if ($class->time <= $to) {
                $class->date = $tomorrow->format('Y-m-d');
                $class->count_subscribers = $this->class_model->count_subscribers($class->date, $class->time)->count_subscribers;
                $class->subscribed = $this->class_model->am_i_subscribed($class->date, $class->time);
                if ($class->subscribed) {
                    $anySubscribed = true;
                }

                $classes[] = clone $class;
            }
        }

        $data['data'] = [
            'classes' => $classes,
            'date' => $now->format('Y-m-d'),
            'time' => $from,
            'any_subscribed' => $anySubscribed
        ];

        $this->load->view('layouts/main', $data);
    }

    public function subscribe()
    {
        $this->class_model->subscribe_class();
        redirect('class_controller');
    }

    public function unsubscribe()
    {
        $this->class_model->unsubscribe_by_date(html_escape($this->input->post('date')));
        redirect('class_controller');
    }
}
