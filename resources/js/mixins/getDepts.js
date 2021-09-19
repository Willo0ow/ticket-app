export default {
    methods: {
        async getDepts() {
            const { data } = await axios.get("/api/departments");
            this.depts = data;
          },
    }
  }
