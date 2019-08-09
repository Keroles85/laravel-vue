<template>
    <div>

        <form>
            <div :class="{ 'invalid-feedback d-block' : errors.length }" v-if="errors.length">
                <b>Please fix the following error(s):</b>
                <ul>
                    <li v-for="error in errors" :key="error.type">{{ error.message }}</li>
                </ul>
            </div>
            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" name="title" id="title" :class="[{'is-invalid' : titleError}, 'form-control']" v-model="articleTitle">
            </div>
            <div class="form-group">
                <label for="body">Article Body</label>
                <textarea name="" id="" cols="30" rows="10" :class="[{'is-invalid' : bodyError}, 'form-control']" v-model="articleBody"></textarea>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">Submit</button>
        </form>

    </div>
</template>

<script>
export default {
    props: ['id', 'title', 'body'],

    data() {
        return {
            articleTitle: '',
            articleBody: '',
            errors: []
        }
    },

    watch: {
        title(val) {
            this.articleTitle = val;
        },
        body(val) {
            this.articleBody = val;
        }
    },

    methods: {
        onSubmit() {
            if(this.articleTitle && this.articleBody) {
                let article = {
                    id: this.id,
                    title: this.articleTitle,
                    body: this.articleBody
                };
                this.$emit('article-update', article);
            } else {
                this.errors = [];
                if (!this.articleTitle) this.errors.push({type: 'title', message : 'Title Required'});
                if (!this.articleBody) this.errors.push({type: 'body', message : 'Body Required'});
            }
        }
    },

    computed: {
        titleError() {
            //return true if errors has title error
            return this.errors.some(error => error.type == 'title');
        },

        bodyError() {
            //return true if errors has body error
            return this.errors.some(error => error.type == 'body');
        }
    }
}
</script>
