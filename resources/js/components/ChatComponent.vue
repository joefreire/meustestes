<style module>
img {
    max-width: 100%;
}
.inbox_people {
    background: #f8f8f8 none repeat scroll 0 0;
    float: left;
    overflow: hidden;
    width: 40%;
    border-right: 1px solid #c4c4c4;
}
.inbox_msg {
    border: 1px solid #c4c4c4;
    clear: both;
    overflow: hidden;
}
.top_spac {
    margin: 20px 0 0;
}

.recent_heading {
    float: left;
    width: 40%;
}
.srch_bar {
    display: inline-block;
    text-align: right;
    width: 60%;
}
.headind_srch {
    padding: 10px 29px 10px 20px;
    overflow: hidden;
    border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
    color: #05728f;
    font-size: 21px;
    margin: auto;
}
.srch_bar input {
    border: 1px solid #cdcdcd;
    border-width: 0 0 1px 0;
    width: 80%;
    padding: 2px 0 4px 6px;
    background: none;
}
.srch_bar .input-group-addon button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    padding: 0;
    color: #707070;
    font-size: 18px;
}
.srch_bar .input-group-addon {
    margin: 0 0 0 -27px;
}

.chat_ib h5 {
    font-size: 15px;
    color: #464646;
    margin: 0 0 8px 0;
}
.chat_ib h5 span {
    font-size: 13px;
    float: right;
}
.chat_ib p {
    font-size: 14px;
    color: #989898;
    margin: auto;
}

.avatar {
    vertical-align: middle;
    width: 25px;
    height: 25px;
    border-radius: 50%;
}
.chat_ib {
    float: left;
    padding: 0 0 0 15px;
    width: 88%;
}

.chat_people {
    overflow: hidden;
    clear: both;
}
.chat_list {
    border-bottom: 1px solid #c4c4c4;
    margin: 0;
    padding: 18px 16px 10px;
}
.inbox_chat {
    height: 550px;
    overflow-y: scroll;
}

.active_chat {
    background: #ebebeb;
}

.incoming_msg_img {
    display: inline-block;
    width: 6%;
}
.received_msg {
    display: inline-block;
    padding: 0 0 0 10px;
    vertical-align: top;
    width: 92%;
}
.received_withd_msg p {
    background: #ebebeb none repeat scroll 0 0;
    border-radius: 3px;
    color: #646464;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width: 100%;
}
.time_date {
    color: #747474;
    display: block;
    font-size: 12px;
    margin: 8px 0 0;
}
.received_withd_msg {
    width: 57%;
}
.mesgs {
    float: left;
    padding: 30px 15px 0 25px;
    width: 60%;
}

.sent_msg p {
    background: #05728f none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 14px;
    margin: 0;
    color: #fff;
    padding: 5px 10px 5px 12px;
    width: 100%;
}
.outgoing_msg {
    overflow: hidden;
    margin: 26px 0 26px;
}
.sent_msg {
    float: right;
    width: 46%;
}
.input_msg_write input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    color: #4c4c4c;
    font-size: 15px;
    min-height: 48px;
    width: 100%;
}

.type_msg {
    border-top: 1px solid #c4c4c4;
    position: relative;
}
.msg_send_btn {
    background: #05728f none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
}
.messaging {
    padding: 0 0 50px 0;
}
.msg_history {
    height: 516px;
    overflow-y: auto;
}
</style>
<template>
    <div class="card">
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <div
                            v-for="item in remetentes"
                            v-bind:key="item.remetente_id"
                            class="chat_list"
                            v-on:click="getMensagens(item.remetente_id)"
                            :class="{ active_chat: item.remetente_id == userAtivo }"
                        >
                            <div class="chat_people">
                                <img
                                    class="avatar"
                                    v-bind:src="[
                                        item.remetente.foto == null
                                            ? 'https://ptetutorials.com/images/user-profile.png'
                                            : item.remetente.foto
                                    ]"
                                    :alt="item.remetente.name"
                                />
                                <span class="ml-2">{{
                                    item.remetente.name.substring(0, 20)
                                }}</span>
                                <span
                                    class="badge badge-primary small float-right"
                                    >{{
                                        moment(item.created_at).format("MMM DD")
                                    }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mesgs">
                    <div class="msg_history">
                        <div v-if="loading == true" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        </div>
                        <div v-for="item in mensagens" v-bind:key="item.id">
                            <div
                                :class="[
                                    item.remetente_id != userId
                                        ? 'incoming_msg'
                                        : 'outgoing_msg'
                                ]"
                            >
                                <div
                                    v-show="item.remetente_id != userId"
                                    class="incoming_msg_img"
                                >
                                    <img
                                        v-if="item.remetente_id != userId"
                                        class="avatar"
                                        v-bind:src="[
                                             item.remetente.foto == null
                                                ? 'https://ptetutorials.com/images/user-profile.png'
                                                : item.remetente.foto
                                        ]"
                                        :alt="item.remetente.name"
                                    />
                                </div>
                                <div
                                    :class="[
                                        item.remetente_id != userId
                                            ? 'received_msg'
                                            : 'sent_msg'
                                    ]"
                                >
                                    <div
                                        :class="[
                                            item.remetente_id != userId
                                                ? 'received_withd_msg'
                                                : ''
                                        ]"
                                    >
                                        <p>
                                            {{ item.mensagem }}
                                        </p>
                                        <span class="time_date">
                                            {{
                                                moment(item.created_at).format(
                                                    "lll"
                                                )
                                            }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input
                                v-on:keyup.enter="envia"
                                v-model="mensagem"
                                type="text"
                                class="write_msg"
                                placeholder="Enviar nova mensagem"
                            />
                            <button
                                v-on:click="envia"
                                class="msg_send_btn"
                                type="button"
                            >
                                <i
                                    class="fa fa-paper-plane-o"
                                    aria-hidden="true"
                                ></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
moment.locale("pt-BR");
import axios from "axios";
export default {
    props: ["data", "user"],
    data() {
        return {
            remetentes: this.data.remetentes,
            mensagens: this.data.mensagens,
            userId: this.user,
            moment: moment,
            mensagem: "",
            loading: false,
            userAtivo: this.data.remetentes[0].remetente_id
        };
    },
    mounted() {
        console.log("Component mounted.");
        console.log(this.data);
    },
    methods: {
        envia: function(event) {
             axios
                .post("/mensagem/store", {
                    mensagem: this.mensagem,
                    destinatario_id: this.userAtivo
                })
                .then(response => {
                    console.log(response);
                    this.mensagens.push({mensagem: this.mensagem, destinatario_id: this.userAtivo , remetente_id: this.userId , created_at: this.moment()});
                    this.mensagem = '';
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getMensagens: function(remetente) {
            //console.log(remetente)
            this.loading = true;
            axios
                .get("/mensagem/getData?remetente="+remetente)
                .then(response => {
                    console.log(response.data.mensagens);
                    this.mensagens = response.data.mensagens;
                })
                .catch(function(error) {
                    console.log(error);
                });
            this.loading = false;
        }
    }
};
</script>
