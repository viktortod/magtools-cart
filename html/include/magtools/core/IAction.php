<?php
/**
 * Interface of Actions
 * Uses Command Design Pattern to execute the action
 * @access public
 *
 * @author Vik
 */
interface IAction {
    function prepare();
    function execute();
    function postExecute();
    function getData();
}
