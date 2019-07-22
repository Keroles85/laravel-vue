<template>
    <div class="article">

        <form>
            <div :class="{ 'invalid-feedback d-block mb-2' : errors.length }" v-if="errors.length">
                <b>Please fix the following error(s):</b>
            </div>
            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" name="title" id="title" :class="[{'is-invalid' : titleError}, 'form-control']" v-model="title">
                <div class="invalid-feedback">Title is required</div>
            </div>
            <div class="form-group">
                <label for="body">Article Body</label>
                <textarea name="" id="" cols="30" rows="10" :class="[{'is-invalid' : bodyError}, 'form-control']" v-model="body"></textarea>
                <div class="invalid-feedback">Body is required</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">Submit</button>
        </form>

    </div>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            body: '',
            errors: []
        }
    },

    methods: {
        onSubmit() {
            if (this.title && this.body) {
                let article = {
                    title: this.title,
                    body: this.body
                };
                this.$emit('article-submitted', article);
            } else {
                this.errors = [];
                if (!this.title) this.errors.push({type: 'title', message : 'Title Required'});
                if (!this.body) this.errors.push({type: 'body', message : 'Body Required'});
            }
        }
    },

    computed: {
        titleError() {
            return this.errors.some(error => error.type == 'title');
        },

        bodyError() {
            return this.errors.some(error => error.type == 'body');
        }
    }
}
</script>

<style lang="scss" scoped>
    .article {
        h1 {
            margin: 2rem 0 1rem 0;
        }
    }
</style>
