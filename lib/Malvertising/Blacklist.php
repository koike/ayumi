<?php

class Blacklist
{
    public static function analyze(string $html)
    {
        $list =
        [
            "04dn8g4f.space",
            "4utergamez.com",
            "adexchangeprediction.com",
            // "adnetworkperformance.com",
            // "adpays.net",
            // "ads.adamoads.com",
            "aduty.com",
            "adrunnr.com",
            // "adx1.com",
            "agpsys.com",
            "bestadbid.com",
            "bestchoisegame.com",
            "bestflashgames.biz",
            "bitadexchange.com",
            "bit-forxx.co",
            "birdieulx.com",
            "boddygame.org",
            "btcpaying",
            "btc-paying",
            "buzzadexchange.com",
            "bw-club.org",
            "click.seodollars.com",
            // "clickadu.com",
            "clotraiam.website",
            "dao-sprit.com",
            "done.witchcraftcash.com",
            "engine.spotscreenred.info",
            "financeandinfo.org",
            "financeinfoon.net",
            "foblengames.com",
            "for-ex-me.com",
            "forxx-ni.com",
            "frstlead.com",            
            "fuel.popclok.com",
            "fx4bit.com",
            "gamer2game.com",
            "go.padsdel.com",
            "grabbgames.com",
            "imbarena.net",
            "kinosmak.net",
            "lebhaile.com",
            // "liveadexchanger.com",
            "loveme2hard.com",
            "lovemetoday.net",
            "maxprofitcontrol.com",
            "medialid.net",
            "mil-tech.org",
            "mmaq.net",
            "mygtmn.com",
            "n152adserv.com",
            "neobitcoin",
            "newtab-media.online",
            "onclickads.net",
            "onclicktop.com",
            // "onclkds.com",
            "onlinegameser.org",
            "onlinevapeshops.org",
            "panasiagrp",
            "park.above.com",
            "perfectuninstallerpro.com",
            "plaith.com",
            // "popcash.net",
            "popclock.com",
            // "poptm.com",
            "portlandmidwife.com",
            "prestoris.com",
            "punditbiz.biz",
            "qstoo.",
            "quickmassiveprofit",
            "quickmoneyprofit",
            "quickwebprofit",
            "quickwwwproit",
            "roughted.com",
            "rtb.adx1.com",
            "sc133.org",
            "seen-on-screen.club",
            "serve.popads.net",
            "serve.popwin.net",
            "sextizer.net",
            "soc-standart.com",
            "star.pulseonclick.com",
            "sync-fx.com",
            // "syndication.exdynsrv.com",
            // "syndication.exoclick.com",
            "track.reacheffect.com",
            "truegamesz.org",
            "usefall.com",
            "voluumtrk.com",
            "vpopulargames.com",
            "wizzcaster.com",
            "wonderlandads.com",
            "www.adexchangeprediction.com",
            "www.codeadnetwork.com",
            "www.nanoadexchange.com",
            "www.onclickpredictiv.com",
            "www.reduxmediia.com",
            "www.terraclicks.com",
            "www.tradedexchange.com",
            "www.xl415.com",
            "www.youradexchange.com",
            "www1.xmediaserve.com",
            "zg1.zeroredirect11.com",
        ];

        foreach($list as $word)
        {
            if(strpos($html, $word) !== false)
            {
                return ['is_suspicious' => true, 'word' => $word];
            }
        }

        if(preg_match('/xml\..{3,20}\.com/', $html))
        {
            return ['is_suspicious' => true, 'word' => 'xml.com'];
        }

        return ['is_suspicious' => false, 'word' => null];
    }
}
