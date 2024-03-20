<?php
namespace QTDL\PROJECT;
class controlDeThi{
private $db;
public $maDT;
public $tenDT;
public $ngaythi;
public $tgthi;
public $mamon;
public $makhoa;
public $socau;
public $socauHoi;
public $errors = [];

public function __construct($pdo)
{
    $this->db = $pdo;
}
public function getValidationErrors()
	{
		return $this->errors;
	}
public function validate(){
    if(!$this->tenDT){
        $this->errors['tenDT']='Tên đề thi không được trống.';
    }
    if(!$this->ngaythi){
        $this->errors['ngaythi']='Ngày thi không được trống.';
    }
    if(!$this->tgthi){
        $this->errors['tgthi']='Thời gian thi không được trống.';
    }
    if(!$this->socau){
        $this->errors['socau']='Số câu không được trống.';
    }
    return empty($this->errors);
	}
public function fillDeThi(array $Dethi){
    if(isset($Dethi['maDT'])){
        $this->maDT = trim($Dethi['maDT']);
    }
    if(isset($Dethi['makhoa'])){
        $this->makhoa = trim($Dethi['makhoa']);
    }
    if(isset($Dethi['mamon'])){
        $this->mamon = trim($Dethi['mamon']);
    }
    if(isset($Dethi['tenDT'])){
        $this->tenDT = trim($Dethi['tenDT']);
    }
    if(isset($Dethi['ngaythi'])){
        $this->ngaythi = trim($Dethi['ngaythi']);
    }
    if(isset($Dethi['socau'])){
        $this->socau = trim($Dethi['socau']);
    }
    if(filter_var($Dethi['tgthi'], FILTER_SANITIZE_NUMBER_INT)>0){
        $this->tgthi = $Dethi['tgthi'];
    }
    return $this;
}
public function getDeThi(){
    $allDeThi = [];
    $statement = $this->db->prepare('select * from dethi');
    $statement->execute();
    while($row = $statement->fetch()){
        $dethi = new controlDeThi($this->db);
        $dethi->fillFromDT($row);
        $allDeThi[] =$dethi;
    }
    return $allDeThi;
}
public function getDeThiTheoMon($mamon){
    $allDeThi = [];
    $statement = $this->db->prepare('select * from dethi where mamon like :mamon');
    $statement->execute(array('mamon'=>$mamon));
    while($row = $statement->fetch()){
        $dethi = new controlDeThi($this->db);
        $dethi->fillFromDT($row);
        $allDeThi[] =$dethi;
    }
    return $allDeThi;
}
public function getDeThiTheoTenMon($tenDT){
    $allDeThi = [];
    $statement = $this->db->prepare('select * from dethi where tenDT like :tenDT');
    $statement->execute(array('tenDT'=>$tenDT));
    while($row = $statement->fetch()){
        $dethi = new controlDeThi($this->db);
        $dethi->fillFromDT($row);
        $allDeThi[] =$dethi;
    }
    return $allDeThi;
}
public function getDeThiMaDeThi($maDT){
    $statement = $this->db->prepare('select * from dethi where maDT like :maDT');
    $statement->execute(array('maDT'=>$maDT));
    while($row = $statement->fetch()){
        $dethi = new controlDeThi($this->db);
        $dethi->fillFromDT($row);
    }
    return $dethi;
}
public function getSoCauHoi($maDT){
    $statement = $this->db->prepare('select count(maCH) as soCauTrongDe from cauhoi where cauhoi.maDT = :maDT');
    $statement->execute(array('maDT'=>$maDT));
    if($row = $statement->fetch()){
        $this->socauHoi= $row['soCauTrongDe'];
    }
    return $this->socauHoi;
}
protected function fillFromDT(array $row)
{
    [
        'maDT' => $this->maDT,
        'tenDT' => $this->tenDT,
        'ngaythi'=>$this->ngaythi,
        'tgthi'=>$this->tgthi,
        'makhoa'=> $this->makhoa,
        'mamon'=>$this->mamon,
        'socau'=>$this->socau
    ] = $row;
    return $this;
}
public function saveDeThi(){
    $result = false;
    if($this->maDT>0){
        $statement = $this->db->prepare(
            'update dethi set tenDT = :tenDT,
            ngaythi = :ngaythi, tgthi = :tgthi, makhoa = :makhoa, mamon = :mamon,socau = :socau
            where maDT = :maDT'
        );
        $result = $statement->execute([
            'tenDT'=> $this->tenDT,
            'ngaythi'=> $this->ngaythi,
            'tgthi'=> $this->tgthi,
            'makhoa'=> $this->makhoa,
            'mamon'=> $this->mamon,
            'maDT'=>$this->maDT,
            'socau'=>$this->socau
        ]);
    }
    else{
        $statement = $this->db->prepare(
            'call insertDeThi(:tenDT,:ngaythi,:tgthi,:makhoa,:mamon,:socau);'
        );
        $result = $statement->execute([
            'tenDT'=> $this->tenDT,
            'ngaythi'=> $this->ngaythi,
            'tgthi'=> $this->tgthi,
            'makhoa'=> $this->makhoa,
            'mamon'=> $this->mamon,
            'socau'=>$this->socau
        ]);
        if ($result) {
            $this->maDT = $this->db->lastInsertId();
        }
    }
    return $result;
}
}