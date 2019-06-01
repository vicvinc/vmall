<template>
<div class="page-container">
    <!-- 联系人卡片 -->
    <van-contact-card
        :type="cardType"
        :name="currentContact.name"
        :tel="currentContact.tel"
        @click="showList = true"
    />

    <!-- 联系人列表 -->
    <van-popup v-model="showList" position="bottom">
        <van-contact-list
            v-model="chosenContactId"
            :list="list"
            @add="onAdd"
            @edit="onEdit"
            @select="onSelect"
        />
    </van-popup>

    <!-- 联系人编辑 -->
    <van-popup v-model="showEdit" position="bottom">
    <van-contact-edit
        :contact-info="editingContact"
        :is-edit="isEdit"
        @save="onSave"
        @delete="onDelete"
    />
    </van-popup>
</div>

</template>

<script>
import { call } from "../../utils";
export default {
  name: "contact",
  data() {
    return {
      chosenContactId: null,
      editingContact: {},
      showList: false,
      showEdit: false,
      isEdit: false,
      list: []
    };
  },

  computed: {
    cardType() {
      return this.chosenContactId !== null ? "edit" : "add";
    },

    currentContact() {
      const id = this.chosenContactId;
      return id !== null ? this.list.filter(item => item.id === id)[0] : {};
    }
  },

  methods: {
    fetchContactList() {
      this.$http
        .get("/api/address")
        .then(data => {
          if (data.length === 0) {
            this.list = this.list.concat({
              name: "张三",
              tel: "13000000000",
              id: 0
            });
            return Promise.reject("no contact info");
          }
          return data;
        })
        .then(call("map", x => ({ ...x, tel: x.phone })))
        .then(data => {
          this.list = data;
          const choosen = this.list.filter(item => item.defaulted)[0];
          this.chosenContactId = choosen.id;
        })
        .catch(console.error);
    },

    // 添加联系人
    onAdd() {
      this.editingContact = { id: this.list.length };
      this.isEdit = false;
      this.showEdit = true;
    },

    // 编辑联系人
    onEdit(item) {
      this.isEdit = true;
      this.showEdit = true;
      this.editingContact = item;
    },

    // 选中联系人
    onSelect() {
      this.showList = false;
      const choosen = this.list.filter(
        item => item.id === this.chosenContactId
      )[0];
      this.$http
        .put(`/api/address/${choosen.id}`, {
          name: choosen.name,
          phone: choosen.tel,
          defaulted: true
        })
        .then(this.$toast("更新默认联系方式成功！"))
        .catch(console.error);
    },

    // 保存联系人
    onSave(info) {
      this.showEdit = false;
      this.showList = false;

      if (this.isEdit) {
        this.list = this.list.map(item => (item.id === info.id ? info : item));
      } else {
        this.list.push(info);
      }
      this.chosenContactId = info.id;
      this.$http
        .post("/api/address", {
          name: info.name,
          phone: info.tel,
          defaulted: true
        })
        .then(data => {
          this.$toast("联系人信息保存成功!");
          this.fetchContactList();
        })
        .catch(console.error);
    },

    // 删除联系人
    onDelete(info) {
      this.showEdit = false;
      this.list = this.list.filter(item => item.id !== info.id);
      if (this.chosenContactId === info.id) {
        this.chosenContactId = null;
      }
      this.$http
        .delete(`/api/address/${info.id}`)
        .then(this.$toast("联系方式删除成功"))
        .then(this.fetchContactList())
        .catch(console.error);
    }
  },
  created() {
    this.fetchContactList();
    this.$store.commit('SET_APP_TITLE', '联系人');
  }
};
</script>
