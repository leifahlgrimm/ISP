<?php
// Start of session
session_start();
// Error Reporting
error_reporting(-1);
ini_set('display_errors','On');

// Datenbankanbindung
const CONFIG_DIR = __DIR__ . '/config';
// Einbinden der restlichen Website-Inhalte
require __DIR__.'/includes.php';