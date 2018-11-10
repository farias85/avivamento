<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 23/10/2017
 * Time: 14:53
 */

namespace AV\CommonBundle\Extension;


interface TicketExtension {
    public function addTickets(int $tickets);

    public function addOneTicket();

    public function removeTickets(int $tickets);

    public function removeOneTicket();
}