<?php
/**
 *  Project: KanFF
 *  File: groupsModel.php functions model for the groups
 *  Author: Samuel Roland
 *  Creation date: 30.05.2020
 */

//Get one group with his id
function getOneGroup($id)
{
    require getOne("groups", $id);
}

//Get all groups that are: visible and ordered by creation_date
function getAllGroups()
{
    $listOfVisibilityAccepted = GROUP_LIST_VISIBILITY;
    foreach ($listOfVisibilityAccepted as $key => $oneOption) {
        if ($oneOption == GROUP_VISIBILITY_INVISIBLE) {
            unset($listOfVisibilityAccepted[$key]);
        }
    }

    $query = "
    SELECT `groups`.*, users.initials AS creator_initials FROM `groups`
INNER JOIN users ON users.id = `groups`.creator_id
WHERE `groups`.visibility in (" . implode(", ", $listOfVisibilityAccepted) . ")
ORDER BY `groups`.creation_date DESC";

    return Query($query, null, true);

}

//Create group
function createGroup($group)
{
    createOne("groups", $group);
}

//Update one group with his id
function updateGroup($group, $id)
{
    updateOne("groups", $id, $group);
}

//Delete one group with his id
function deleteGroup($id)
{
    deleteOne("groups", $id);
}

?>
