<?php
class PhoneValidator extends RegexValidator{
    protected $regex = '/^(0)([0-9]{9})/';
}