<script setup>
defineProps({
    logo: Object,
    description: String,
    contact: Object,
    links: Object,
    rrss: Object,
    copyright: String,
});
</script>

<template>
    <footer id="footer" class="footer">
        <div class="footer__container container">
            <div class="footer__column">
                <img
                    v-if="logo?.url"
                    :src="logo.url"
                    :alt="logo.alt"
                    class="footer__logo"
                />
                <p v-if="description" class="footer__description">
                    {{ description }}
                </p>
                <ul class="footer__rrss">
                    <li
                        v-for="(link, index) in rrss"
                        :key="index"
                        class="footer__rrss--item"
                    >
                        <a
                            :href="link.url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="footer__rrss--a"
                        >
                            <img
                                :src="link.icon.url"
                                :alt="link.icon.alt"
                                class="footer__rrss--icon"
                            />
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer__column">
                <h3 v-if="links.title" class="footer__column--title">
                    {{ links.title }}
                </h3>
                <nav class="footer__nav">
                    <ul class="footer__nav--ul">
                        <li
                            v-for="(link, i) in links.list"
                            :key="i"
                            class="footer__nav--li"
                        >
                            <a :href="link.url" class="footer__nav--a">{{
                                link.title
                            }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer__column">
                <h3 v-if="contact?.title" class="footer__column--title">
                    {{ contact.title }}
                </h3>
                <a
                    v-if="contact?.mail"
                    :href="`mailto:${contact.mail.title}`"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer__contact"
                >
                    <img
                        :src="contact.mail.icon.url"
                        :alt="contact.mail.icon.url"
                    />
                    {{ contact.mail.title }}</a
                >
                <a
                    v-if="contact?.phone"
                    :href="`tel:${contact.phone.title}`"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer__contact"
                >
                    <img
                        :src="contact.phone.icon.url"
                        :alt="contact.phone.icon.url"
                    />
                    {{ contact.phone.title }}</a
                >
                <address v-if="contact?.address" class="footer__contact">
                    <img
                        :src="contact.address.icon.url"
                        :alt="contact.address.icon.url"
                    />
                    {{ contact.address.title }}
                </address>
            </div>
        </div>
        <div class="footer__container--bottom container">
            <p v-if="copyright" class="footer__copyright">{{ copyright }}</p>
        </div>
    </footer>
</template>

<style lang="scss">
.footer {
    padding: 50px 0 30px;
    background-color: #101217;
    color: #fff;

    &__rrss {
        $item: &;
        display: flex;
        align-items: center;
        gap: 15px;
        &--icon {
            max-width: 30px;
            max-height: 30px;
            transition: all 500ms ease-in-out;
        }
        &--a {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            justify-content: center;
            border: 1px solid #da6f17;
            display: flex;
            align-items: center;
            transition: all 300ms ease-in-out;
            &:hover {
                background-color: #da6f17;

                // #{$item}--icon{
                //     filter: brightness(0) invert(1); /* Convierte el blanco a negro */
                //     mix-blend-mode: multiply;
                //     background-color: #da6f17;
                // }
            }
        }
    }
    &__container {
        display: flex;
        gap: 50px;
        @media (max-width: 992px) {
            flex-direction: column;
        }
        &--bottom {
            border-top: 1px solid #ffffff;
            margin-top: 50px;
            padding-top: 20px;
            @media (max-width: 992px) {
                width: 93%;
            }
        }
    }
    &__copyright {
        font-family: "Dm sans", sans-serif;
        font-size: 16px;
    }
    &__description {
        font-family: "Dm sans", sans-serif;
        font-size: 18px;
        max-width: 450px;
    }
    &__logo {
        max-width: 300px;
    }
    &__column {
        display: flex;
        flex-direction: column;
        gap: 20px;
        flex: 1;
        &:not(:first-child) {
            max-width: 250px;
        }
        &--title {
            font-family: "Dm sans", sans-serif;
            font-size: 32px;
            line-height: 50px;
            color: #fff;
            border-bottom: 2px solid #da6f17;
            filter: brightness(0.8);
            width: fit-content;
        }
    }
    &__nav {
        display: flex;
        flex-direction: column;
        &--a {
            font-family: "Dm sans", sans-serif;
            font-size: 20px;
            line-height: 40px;
            color: #fff;
            transition: all 500ms ease-in-out;
            filter: brightness(0.7);
            &:hover {
                filter: brightness(1);
            }
        }
    }
    &__contact {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-family: "Dm sans", sans-serif;
        font-size: 20px;
        line-height: 25px;
        color: #fff;
        transition: all 500ms ease-in-out;
        filter: brightness(0.7);
        &:hover {
            filter: brightness(1);
        }
    }
}
</style>
