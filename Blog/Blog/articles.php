<?php
function articles_load($link)
{
    $sql = 'SELECT * FROM `posts` ORDER BY date DESC';
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            return mysqli_stmt_get_result($stmt);
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}

function get_article($link, $id)
{
    $sql = 'SELECT * FROM `posts` WHERE id=' . $id . '';
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            return mysqli_stmt_get_result($stmt);
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}

function delete_article($link, $id)
{
    $sql = 'DELETE FROM `posts` WHERE id=' . $id . '';
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            header('location: ../index.php');
        }
    }
}

function update_article($link, $id, $title, $thumbnail, $content, $git_commit, $worktime)
{
    $sql = 'UPDATE `posts` SET title=?, thumbnail=?, content=?, git_commit=?, date=current_timestamp(), worktime=? WHERE id=' . $id;

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $param_title, $param_thumbnail, $param_content, $param_git_commit, $param_worktime);

        $param_title = $title;
        $param_thumbnail = $thumbnail;
        $param_content = $content;
        $param_git_commit = $git_commit;
        $param_worktime = $worktime;

        if (mysqli_stmt_execute($stmt)) {
            header('location: ../index.php');

        }
    }
}
