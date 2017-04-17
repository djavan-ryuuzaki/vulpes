<?php

namespace Lagopus\Util;
/**
 * Copyright 2015 
 * 
 * PHP implementation of Twitter's Snowflake Unique ID generation service
 * 
 * @author skey <skey@115.com>
 */
define("WORKERID_BITS", 5);
define("DATACENTERID_BITS", 5);
define("SEQUENCE_BITS", 12);
define("MAX_WORKERID", -1 ^ (-1 << WORKERID_BITS));
define("MAX_DATACENTERID", -1 ^ (-1 << DATACENTERID_BITS));
define("WORKERID_SHIFT", SEQUENCE_BITS);
define("DATACENTERID_SHIFT", SEQUENCE_BITS + WORKERID_BITS);
define("TIMESTAMPLEFT_SHIFT", SEQUENCE_BITS + WORKERID_BITS + DATACENTERID_BITS);
define("SEQUENCE_MASK", -1 ^ (-1 << SEQUENCE_BITS));
define("EPOCH", 1288834974657);
class PHPSnowflake
{
    private $workerid;
    private $datacenterid;
    private $sequence = 0;
    private $last_timestamp = 1;
    public function __construct($workerid = 1, $datacenerid = 1)
    {
        $workerid = floor($workerid);
        $datacenerid = floor($datacenerid);
        if ($workerid > MAX_WORKERID || $workerid < 0)
        {
            trigger_error(sprintf("workerid can't be greater than %d or less than 0", $workerid));
            return false;
        }
        if ($datacenerid > MAX_DATACENTERID || $datacenerid < 0)
        {
            trigger_error(sprintf("datacenterid can't be greater than %d or less than 0", $workerid));
            return false;
        }
        $this->workerid = $workerid;
        $this->datacenterid = $datacenerid;
    }
    public function get_nextid()
    {
        $timestamp = $this->get_timestamp();
        if ($timestamp < $this->last_timestamp)
        {
            trigger_error(sprintf("Clock is moving backwards. Rejecting requests until %d.", $timestamp));
            return false;
        }
        if ($timestamp == $this->last_timestamp)
        {
            $this->sequence = $this->sequence + 1 & SEQUENCE_MASK;
            if ($this->sequence == 0)
            {
                $next_timestamp = $this->timestamp();
                while ($next_timestamp <= $timestamp)
                {
                    $next_timestamp = $this->timestamp();
                }
                $timestamp = $next_timestamp;
            }
        }
        else
        {
            $this->sequence = 0;
        }
        $this->last_timestamp = $timestamp;
        return (($this->last_timestamp - EPOCH) << TIMESTAMPLEFT_SHIFT) |
                ($this->datacenterid << DATACENTERID_SHIFT) |
                ($this->workerid << WORKERID_SHIFT) |
                $this->sequence;
    }
    public function get_wokerid()
    {
        return $this->workerid;
    }
    public function get_sequence()
    {
        return $this->sequence;
    }
    public function get_timestamp()
    {
        return floor(microtime(true) * 1000);
    }
}
?>