<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service\SyncMap;

use Twilio\InstanceContext;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class SyncMapItemContext extends InstanceContext
{
    /**
     * Initialize the SyncMapItemContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $serviceSid The service_sid
     * @param string $mapSid The map_sid
     * @param string $key The key
     * @return \Twilio\Rest\Sync\V1\Service\SyncMap\SyncMapItemContext
     */
    public function __construct(Version $version, $serviceSid, $mapSid, $key)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('serviceSid' => $serviceSid, 'mapSid' => $mapSid, 'key' => $key);

        $this->uri = '/Services/' . rawurlencode($serviceSid) . '/Maps/' . rawurlencode($mapSid) . '/Items/' . rawurlencode($key) . '';
    }

    /**
     * Fetch a SyncMapItemInstance
     *
     * @return SyncMapItemInstance Fetched SyncMapItemInstance
     */
    public function fetch()
    {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new SyncMapItemInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['mapSid'],
            $this->solution['key']
        );
    }

    /**
     * Deletes the SyncMapItemInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete()
    {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Update the SyncMapItemInstance
     *
     * @param array $data The data
     * @return SyncMapItemInstance Updated SyncMapItemInstance
     */
    public function update($data)
    {
        $data = Values::of(array('Data' => Serialize::jsonObject($data)));

        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new SyncMapItemInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['mapSid'],
            $this->solution['key']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Sync.V1.SyncMapItemContext ' . implode(' ', $context) . ']';
    }
}