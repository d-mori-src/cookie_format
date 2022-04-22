<div class="cookie-consent">
    <div class="cookie-text">
        当サイトでは、サイトの利便性向上のため、クッキー(Cookie)を使用しています。<br class="pc" />
        サイトのクッキー(Cookie)の使用に関しては、弊社の
        <a href="" target="_blank" rel="noopener noreferrer">「Cookieの取り扱い」</a>
        をお読みください。
    </div>
    <div class="cookie-agree">同意する</div>
</div>

<style>
    .sp { display: block; }
    .pc { display: none; }

    .cookie-consent {
        display: flex;
        align-items: center;
        flex-direction: column;
        position: fixed;
        bottom: -400px;
        left: 0;
        text-align: justify;
        background: rgba(0, 0, 0, 0.7);
        padding: 20px;
        visibility: visible;
        -webkit-transition: .5s;
        transition: .5s;
    }

    .cookie-consent .cookie-text {
        font-size: 14px;
        font-weight: 300;
        line-height: 1.5;
        color: #fff;
        margin: 0 0 16px 0;
    }

    .cookie-consent .cookie-text a {
        color: #fff;
    }

    .cookie-consent .cookie-agree {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        line-height: 1;
        color: #000;
        width: 200px;
        padding: 14px;
        background: #fff;
    }

    .cookie-consent .cookie-agree:hover {
    cursor: pointer;
    }

    .cookie-consent.is-show {
        bottom: 0;
    }

    /* パッと消える */
    .cc-hide1 {
        display: none;
    }

    /* ゆっくり消える */
    .cc-hide2 {
        animation: hide 1s linear 0s;
        animation-fill-mode: forwards;
    }

    @-webkit-keyframes hide {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
            visibility: hidden;
        }
    }

    @keyframes hide {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
            visibility: hidden;
        }
    }

    @media screen and (min-width: 768px) {
        .sp { display: none; }
        .pc { display: block; }
        .cookie-consent {
            flex-direction: row;
            position: fixed;
            justify-content: center;
            width: 100%;
        }
        .cookie-consent .cookie-text {
            font-size: 12px;
            line-height: 1.7;
            margin: 0 40px 0 0;
        }
        .cookie-consent .cookie-agree {
            font-size: 12px;
            width: 100px;
            padding: 20px;
        }
    }
</style>

<script>
    (function() {
        const expire = 365; // 有効期限（日）
        let cc = document.querySelector('.cookie-consent');
        let ca = document.querySelector('.cookie-agree');
        const flag = localStorage.getItem('popupFlag');
        if (flag != null) {
        const data = JSON.parse(flag);
        if (data['value'] == 'true') {
            window.onscroll = () => {
            if (window.pageYOffset) {
                popup();
            }
            }
        } else {
            const current = new Date();
            if (current.getTime() > data['expire']) {
            setWithExpiry('popupFlag', 'true', expire);
            window.onscroll = () => {
                if (window.pageYOffset) {
                popup();
                }
            }
            }      
        }
        } else {
        setWithExpiry('popupFlag', 'true', expire);
        window.onscroll = () => {
            if (window.pageYOffset) {
            popup();
            }
        }
        }
        ca.addEventListener('click', () => {
        cc.classList.add('cc-hide1');
        setWithExpiry('popupFlag', 'false', expire);
        });
        
        function setWithExpiry(key, value, expire) {
        const current = new Date();
        expire = current.getTime() + expire * 24 * 3600 * 1000;
        const item = {
            value: value,
            expire: expire
        };
        localStorage.setItem(key, JSON.stringify(item));
        }
        
        function popup() {
        cc.classList.add('is-show');
        }
    }());
</script>