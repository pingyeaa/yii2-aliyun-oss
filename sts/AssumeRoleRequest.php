<?php


class AssumeRoleRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("Sts", "2015-04-01", "AssumeRole");
		$this->setProtocol("https");
	}

	private  $durationSeconds;

	private  $policy;

	private  $roleArn;

	private  $roleSessionName;

	public function getDurationSeconds() {
		return $this->durationSeconds;
	}

	public function setDurationSeconds($durationSeconds) {
		$this->durationSeconds = $durationSeconds;
		$this->queryParameters["DurationSeconds"]=$durationSeconds;
	}

	public function getPolicy() {
		return $this->policy;
	}

	public function setPolicy($policy) {
		$this->policy = $policy;
		$this->queryParameters["Policy"]=$policy;
	}

	public function getRoleArn() {
		return $this->roleArn;
	}

	public function setRoleArn($roleArn) {
		$this->roleArn = $roleArn;
		$this->queryParameters["RoleArn"]=$roleArn;
	}

	public function getRoleSessionName() {
		return $this->roleSessionName;
	}

	public function setRoleSessionName($roleSessionName) {
		$this->roleSessionName = $roleSessionName;
		$this->queryParameters["RoleSessionName"]=$roleSessionName;
	}

    public function setFormat($format)
    {
        $this->acceptFormat = $format;
    }
	
}