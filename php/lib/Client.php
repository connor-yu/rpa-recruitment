<?php
namespace MyGreeter;

class Client
{
    private $now_time;       // 当前时间戳
    private $start_time;     // 当前日期零点的时间戳
    private $middle_time;    // 当前日期中午12点的时间戳
    private $after_time;     // 当前日期下午6点的时间戳
    private $end_time;       // 当前日期23点59分59秒的时间戳

    private $errors = [];    // 保存错误信息

    public function __construct($time = NULL)
    {
        date_default_timezone_set('PRC');   // 默认设置时区为中国

        $now_time = time();
        $today = date('Y-m-d', $now_time);

        if ($time === NULL) {
            $this->now_time = $now_time;
        } else {
            // 如果输入的时间格式错误，保存错误信息并返回
            $match = $this->validateTimeFormat($time);
            if ($match == 0) {
                $this->errors['construct'] = 'Time format error';
                return;
            }

            $this->now_time = strtotime($today . ' ' . $time);
        }

        $this->start_time = strtotime($today);
        $this->middle_time = strtotime($today.' 12:00:00');
        $this->after_time = strtotime($today. ' 18:00:00');
        $this->end_time = strtotime($today. ' 23:59:59');
    }

    public function getGreeting()
    {
        if (!empty($this->errors)) {
            return $this->errors;
        }

        if ($this->now_time >= $this->start_time && $this->now_time < $this->middle_time) {
            return "Good morning";
        } elseif ($this->now_time < $this->after_time) {
            return "Good afternoon";
        } elseif ($this->now_time <= $this->end_time) {
            return "Good evening";
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function validateTimeFormat($time)
    {
        $pattern = "/^([0-1]\d|2[0-3]):[0-5]\d:[0-5]\d$/";
        return preg_match($pattern, $time);
    }
}
