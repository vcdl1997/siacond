<?php

class UserProfileRepository extends Repository
{
    function __construct(
        UserProfile $model = null,
        PDO $conn
    )
    {
        parent::__construct(empty($model) ? new UserProfile() : $model, $conn);
    }

    public function getProfileByUserId(int $userId) :string
    {
        $sql = "
            SELECT 
                " . Profile::CONSTANT . " as profile 
            FROM " . UserProfile::TABLE . " as user_profile
            INNER JOIN " . Profile::TABLE . " AS profile ON profile." . Profile::ID . " = user_profile." . UserProfile::PROFILE_ID . "
            WHERE user_profile.". UserProfile::USER_ID ." = :". UserProfile::USER_ID
        ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":" . UserProfile::USER_ID => $userId]);
        $result = $stmt->fetch(PDO::FETCH_LAZY);

        return $result->profile;
    }
}