<?php

class checkCodeRequest
{
    public function verifyQueryString($queryString)
    {
        if ($queryString) {
            if (isset($queryString['page'])) {
                if ($queryString['page']) {
                    switch ($queryString['page']) {
                        case 'login':
                            return $queryString['page'];
                        case 'register':
                            return $queryString['page'];
                        case 'verify':
                            return $queryString['page'];
                        default:
                            return NULL;
                    }
                } else {
                    header('location:errors/404.php');
                }
            } else {
                header('location:errors/404.php');
            }
        } else {
            header('location:errors/404.php');
        }
    }
}
