<?php

class UserPermissionRepository extends Repository
{
    function __construct(
        UserPermission $model = null,
        PDO $conn
    )
    {
        parent::__construct(empty($model) ? new UserPermission() : $model, $conn);
    }

    public function listAllByUserIdAndCondominiumId(int $userId, int $condominiumId) :array
    {
        $sql = "
            SELECT 
                user." . Permission::CONSTANT . " AS permission
            FROM " . UserPermission::TABLE . " AS user_permission
            INNER JOIN " . Permission::TABLE . " AS permission ON permission." . Permission::ID . " = user_permission." . UserPermission::PERMISSION_ID . "
            WHERE user_permission.". UserPermission::USER_ID ." = :". UserPermission::USER_ID . "
            AND user_permission.". UserPermission::CONDOMINIUM_ID ." = :". UserPermission::CONDOMINIUM_ID
        ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":". UserPermission::USER_ID => $userId,
            ":". UserPermission::CONDOMINIUM_ID => $condominiumId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }
}