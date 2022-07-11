<?php

// Findet heraus ob ein Request vom Typ POST ist
function isPost(): bool{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}