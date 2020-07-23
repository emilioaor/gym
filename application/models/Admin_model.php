<?php
class Admin_model extends CI_Model {
	
    //Count Total rows in Member_reg Table
	public function count_members()
	{
		$this->db->select('*');
		$this->db->from('member_reg');
		$this->db->where('MONTH(member_join_date)', date('m')); //For Current Month
		$this->db->where('YEAR(member_join_date)', date('Y')); //For Ciurrent Year
		$query = $this->db->get();

		return $query->num_rows();
	}
	
    //Count Total Members 
	public function total_members()
	{
		$query = $this->db->get('member_reg');
		return $query->num_rows();
	}
    
    //Get Total Plans
	public function total_plans()
	{
		$query = $this->db->get('plans');
		return $query->num_rows();
	}
    
    //Get Expired Members
	public function get_expire_members()
	{	
		$this->db->select('*');
		$this->db->from('member_reg');
		$this->db->where('member_reg.member_exp_date <', date('Y-m-d'));
		$this->db->join('plans','member_reg.member_plan_id = plans.plan_id');
		$query = $this->db->get();
		return $query->num_rows();
	}
    
    //Get Unpaid Members
	public function get_unpaid_members()
	{
		$select = array('member_histroy.*','plans.plan_name','member_reg.member_reg_id ',' member_reg.member_name');
		$this->db->select($select);
		$this->db->from('member_histroy');
		$this->db->where('member_histroy.member_payable_amount >', 0);
		$this->db->join('plans','member_histroy.member_plan_id = plans.plan_id');
		$this->db->join('member_reg','member_histroy.member_reg_id = member_reg.member_reg_id');
		$query = $this->db->get();
		return $query->num_rows();
	}	
	
	//Find Payment per Month
	public function payments_per_month()
	{
		$this->db->select('member_histroy.*');
		$this->db->from('member_histroy');
		$this->db->where('MONTH(member_his_pay_date) =',date('m'));
		$query = $this->db->get();
		if($query->num_rows() > 0 )
		{
			return $query->result();
		} else 
		{
			return NULL;
		}
	}

	public function getBirthdayDates()
	{
		$this->db->select('member_img image, member_name title, member_birthday_date start');
		$this->db->from('member_reg');
		$query = $this->db->get();
		return json_encode( $query->result() );
	}

	public function getBirthday()
	{
        $date = new \DateTime(date('Y-m-d'));
		$this->db->select('member_name');
		$this->db->from('member_reg');
        $this->db->where('member_birthday_date LIKE', '%' . $date->format('-m-d'));
		$query = $this->db->get();

		if($query->num_rows() > 0 )
		{
			return $query->result();
		} else 
		{
			return [];
		}
	}

    public function getBirthdayByDate($date)
    {
        $date = new \DateTime($date);

        $this->db->select('member_reg.*, plans.plan_name');
        $this->db->from('member_reg');
        $this->db->where('member_birthday_date LIKE', '%' . $date->format('-m-d'));
        $this->db->join('plans','member_reg.member_plan_id = plans.plan_id');
        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            return $query->result();
        } else
        {
            return [];
        }
    }

	public function getBirthdayCalendar()
    {
        $weekDays = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

        $start = new \DateTime(date('Y-m-01'));
        $end = (new \DateTime(date('Y-m-01')))->modify('+1 month')->modify('-1 day');
        $calendar = [];

        while ($start <= $end) {

            $week = [];

            foreach ($weekDays as $weekDay) {

                $wd = strtoupper(substr($start->format('l'), 0, 3));
                $week[$weekDay] = [
                    'day' => '',
                    'members' => []
                ];

                if ($wd === $weekDay && $start <= $end) {
                    $week[$weekDay]['day'] = $start->format('d M');
                    $week[$weekDay]['members'] = $this->getBirthdayByDate($start->format('Y-m-d'));
                    $start->modify('+1 day');
                }
            }

            $calendar[] = $week;
        }

        return $calendar;
    }

    public function next5daysBirthdays()
    {
        $start = new \DateTime();
        $end = (new \DateTime())->modify('+5 days');
        $next5days = [];

        while ($start <= $end) {

            $members = $this->getBirthdayByDate($start->format('Y-m-d'));

            $next5days = array_merge($next5days, $members);

            $start->modify('+1 day');
        }

        return $next5days;
    }
 }