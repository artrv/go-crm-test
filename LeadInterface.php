<?php

interface LeadServiceInterface {

/**
 * @param Lead $lead
 * @return int
 */
public function setLead(Lead $lead): int;
}
