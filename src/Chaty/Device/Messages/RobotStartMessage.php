<?php

namespace Weiliu\Open\Chaty\Device\Messages;

use Weiliu\Open\Kernel\Support\Str;

/**
 * Class RobotStartMessage
 *
 * @package Weiliu\Open\Chaty\Device\Messages
 */
class RobotStartMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('robot');
        $this->setType('start');
        $this->setOs('ipados');
        $data = [
            'hash' => $this->get('hash', $this->get('unique', $this->get('token'))),
            'unique' => $this->get('unique', $this->get('token')),
        ];
        if ($this->has('tag')) {
            $data['tag'] = $this->get('tag');
        }
        if ($this->has('wxid')) {
            $data['agent_wxId'] = $this->get('wxid');
        }
        $this->setData(
            array_merge(
                $data,
                $this->createDeviceData($data['unique'])
            )
        );
        $this->attributes = [];
    }

    /**
     * @param string $str
     *
     * @return array
     */
    protected function createDeviceData(string $str): array
    {
        $deviceId = strtolower(md5(uniqid($str)));

        $strIdfv = strtoupper(md5(uniqid($str . '|1')));
        $idfv = substr($strIdfv, 0, 8) . '-' .
            substr($strIdfv, 8, 4) . '-' .
            substr($strIdfv, 12, 4) . '-' .
            substr($strIdfv, 16, 4) . '-' .
            substr($strIdfv, -12);

        $strIdfa = strtoupper(md5(uniqid($str . '|2')));
        $idfa = substr($strIdfa, 0, 8) . '-' .
            substr($strIdfa, 8, 4) . '-' .
            substr($strIdfa, 12, 4) . '-' .
            substr($strIdfa, 16, 4) . '-' .
            substr($strIdfa, -12);

        $strMac = strtolower(md5(uniqid($str . '|3')));
        $mac = substr($strMac, 0, 2) . ':' .
            substr($strMac, 2, 2) . ':' .
            substr($strMac, 4, 2) . ':' .
            substr($strMac, 6, 2) . ':' .
            substr($strMac, 8, 2) . ':' .
            substr($strMac, 10, 2);

        $strBssid = strtolower(md5(uniqid($str . '|4')));
        $bssid = substr($strBssid, 0, 2) . ':' .
            substr($strBssid, 2, 2) . ':' .
            substr($strBssid, 4, 2) . ':' .
            substr($strBssid, 6, 2) . ':' .
            substr($strBssid, 8, 2) . ':' .
            substr($strBssid, 10, 2);

        $strSandBoxBundleUuid = strtoupper(md5(uniqid($str . '|5')));
        $sandBoxBundleUuid = substr($strSandBoxBundleUuid, 0, 8) . '-' .
            substr($strSandBoxBundleUuid, 8, 4) . '-' .
            substr($strSandBoxBundleUuid, 12, 4) . '-' .
            substr($strSandBoxBundleUuid, 16, 4) . '-' .
            substr($strSandBoxBundleUuid, -12);

        $strSandBoxDataUuid = strtoupper(md5(uniqid($str . '|6')));
        $sandBoxDataUuid = substr($strSandBoxDataUuid, 0, 8) . '-' .
            substr($strSandBoxDataUuid, 8, 4) . '-' .
            substr($strSandBoxDataUuid, 12, 4) . '-' .
            substr($strSandBoxDataUuid, 16, 4) . '-' .
            substr($strSandBoxDataUuid, -12);

        $randNum = rand(1, 100);

        return [
            'deviceID' => $deviceId,
            'IDFV' => $idfv,
            'IDFA' => $idfa,
            'mac' => $mac,
            'Bssid' => $bssid,
            'Ssid' => $deviceId,
            'SandBoxBundleUUID' => $sandBoxBundleUuid,
            'SandBoxDataUUID' => $sandBoxDataUuid,
            'DeviceName' => $this->getDeviceName($randNum),
            'WifiName' => $this->getWifiName($randNum, $bssid),
            'clientCheckUUID' => strtoupper(md5(uniqid($str . '|7')))
        ];
    }

    /**
     * DeviceName规则
     * 1. 拼音+（1-4）数字生成
     * 2. iPad
     *
     * @param int $rand
     *
     * @return string
     */
    protected function getDeviceName(int $rand): string
    {
        if ($rand <= 40) {
            return 'iPad';
        } else {
            return Str::random(4) . mt_rand(1, 999) . "'siPad";
        }
    }

    protected function getName(): string
    {
        $names = '赵钱孙李周吴郑王冯陈褚卫蒋沈韩杨朱秦尤许何吕施张孔曹严华金魏陶姜戚谢邹喻柏水窦章云苏潘葛奚范彭郎鲁韦昌马苗凤花方俞任袁柳酆鲍史唐费廉岑薛雷贺倪汤滕殷罗毕郝邬安常乐于时傅皮卞齐康伍余元卜顾孟平黄和穆萧尹姚邵湛汪祁毛禹狄米贝明臧计伏成戴谈宋茅庞熊纪舒屈项祝董梁杜阮蓝闵席季麻强贾路娄危江童颜郭梅盛林刁钟徐邱骆高夏蔡田樊胡凌霍虞万支柯昝管卢莫经房裘缪干解应宗丁宣贲邓郁单杭洪包诸左石崔吉钮龚程嵇邢滑裴陆荣翁荀羊於惠甄曲家封芮羿储靳汲邴糜松井段富巫乌焦巴弓牧隗山谷车侯宓蓬全郗班仰秋仲伊宫宁仇栾暴甘钭厉戎祖武符刘景詹束龙叶幸司韶郜黎蓟薄印宿白怀蒲邰从鄂索咸籍赖卓蔺屠蒙池乔阴鬱胥能苍双闻莘党翟谭贡劳逄姬申扶堵冉宰郦雍卻璩桑桂濮牛寿通边扈燕冀郏浦尚农温别庄晏柴瞿阎充慕连茹习宦艾鱼容向古易慎戈廖庾终暨居衡步都耿满弘匡国文寇广禄阙东欧殳沃利蔚越夔隆师巩厍聂晁勾敖融冷訾辛阚那简饶空曾毋沙乜养鞠须丰巢关蒯相查后荆红游竺权逯盖益桓公万俟司马上官欧阳夏侯诸葛闻人东方赫连皇甫尉迟公羊澹台公冶宗政濮阳淳于单于太叔申屠公孙仲孙轩辕令狐钟离宇文长孙慕容鲜于闾丘司徒司空丌官司寇仉督子车颛孙端木巫马公西漆雕乐正壤驷公良拓跋夹谷宰父谷梁晋楚闫法汝鄢涂钦段干百里东郭南门呼延归海羊舌微生岳帅缑亢况郈有琴梁丘左丘东门西门商牟佘佴伯赏南宫墨哈谯笪年爱阳佟第五言福百家姓终';
        $length = mb_strlen($names);
        $rand = mt_rand(0, $length - 1);
        $char = mb_substr($names, $rand, 1);
        return trim($char);
    }

    /**
     * wifiname 规则：
     * 1、小米、TPLINK、腾达、DLINK、华为 60%
     * 2、栋号+号号，以-或者_分隔 40%
     */
    protected function getWifiName(int $rand, string $bssid): string
    {
        if ($rand <= 60) {
            $brandList = ['Xiaomi' => 4, 'TP-LINK' => 4, 'Tenda' => 6];
            $brand = array_rand($brandList, 1);
            $macLast = strtoupper(substr(strtr($bssid, [':' => '']), -$brandList[$brand]));
            return "{$brand}_{$macLast}";
        } else {
            return mt_rand(1, 30) . '_' . mt_rand(100, 110); // 1-30栋, 每层10间房子
        }
    }
}