<?php
namespace App\Models;
use CodeIgniter\Model;

class BankAccountModel extends Model
{
    protected $table = 'bank_accounts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';
    protected $allowedFields = ['bank_name', 'branch', 'account_number'];
}

