<?php
// dynamic table
// dynamic rows
// dynamic columns
// check if gender of user == m ==> male
// check if gender of user == f ==> female



$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ]
    ],
    (object)[
        'id' => 3,
        'name' => 'mena',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ]
    ]
];

// $number = 5;
// for ($i=0; $i < 5; $i++) { 
//    echo "<p>Hello</p>";
// }

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <table class="table table-dark">
        <thead>
            <tr>
                <?php foreach ($users[0] as $property => $value) { ?>
                    <th scope="col"><?= $property ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user) { ?>
                <tr>
                    <?php foreach ($user as $property => $value) { ?>
                        <td><?php
                            if (gettype($value) != 'array' && gettype($value) != 'object') {
                                echo $value;
                            }else{
                                foreach ($value as $k => $v) {
                                    if($k == 'gender'){
                                        if($v == 'm'){
                                            $v = 'male';
                                        }else{
                                            $v = 'female';
                                        }
                                    }
                                    echo $v.',';
                                }
                            }
                            ?>
                        </td>
                    <?php } ?>

                </tr>
            <?php } ?>

        </tbody>
    </table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://st

</html>