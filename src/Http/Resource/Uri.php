<?php
namespace Ship\Hull\Http\Resource;

class Uri
{
    /**
     * Permanent URI Schemes.
     */
    const SCHEMES = [
        'fax',
        'filesystem',
        'mailserver',
        'modem',
        'pack',
        'prospero',
        'snews',
        'videotex',
        'wais',
        'wpid',
        'z39.50',
        'aaa',
        'aaas',
        'about',
        'acap',
        'acct',
        'cap',
        'cid',
        'coap',
        'coaps',
        'crid',
        'data',
        'dav',
        'dict',
        'dns',
        'example',
        'file',
        'ftp',
        'geo',
        'go',
        'gopher',
        'h323',
        'http',
        'https',
        'iax',
        'icap',
        'im',
        'imap',
        'info',
        'ipp',
        'ipps',
        'iris',
        'iris.beep',
        'iris.lwz',
        'iris.xpcs',
        'jabber',
        'ldap',
        'mailto',
        'mid',
        'msrp',
        'msrps',
        'mtqp',
        'mupdate',
        'news',
        'nfs',
        'ni',
        'nih',
        'nntp',
        'opaquelocktoken',
        'pkcs11',
        'pop',
        'pres',
        'reload',
        'rtsp',
        'rtsps',
        'rtspu',
        'service',
        'session',
        'shttp',
        'sieve',
        'sip',
        'sips',
        'sms',
        'snmp',
        'soap.beep',
        'soap.beeps',
        'stun',
        'stuns',
        'tag',
        'tel',
        'telnet',
        'tftp',
        'thismessage',
        'tip',
        'tn3270',
        'turn',
        'turns',
        'tv',
        'urn',
        'vemmi',
        'vnc',
        'ws',
        'wss',
        'xcon',
        'xcon-userid',
        'xmlrpc.beep',
        'xmlrpc.beeps',
        'xmpp',
        'z39.50r',
        'z39.50s'
    ];
    
    /**
     * Check if the scheme is valid.
     *
     * @param  string  $scheme URI Scheme
     * @return bool
     */
    public static function isValid($scheme)
    {
        //Check if the uri is a string
        if (!is_string($scheme)) {
            throw new \InvalidArgumentException('Scheme must be a string.');
        }

        return in_array(strtolower($scheme), self::SCHEMES);
    }
}
